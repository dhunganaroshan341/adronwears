<?php
// app/Models/BaseModel.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class BaseModel extends Model
{
    protected array $imageFields = ['image'];

    public function __get($key)
    {
        $value = parent::__get($key);

        if (in_array($key, $this->getImageFields()) && is_string($value)) {
            // If $value already a full URL, return as-is
            if (str_starts_with($value, 'http://') || str_starts_with($value, 'https://')) {
                return $value;
            }

            return str_starts_with($value, 'uploads/')
                ? asset($value)
                : asset('uploads/' . $value);
        }

        return $value;
    }


    protected function getImageFields(): array
    {
        return $this->imageFields;
    }

    // ✅ Enhanced uploadImage() with deletion flag
    public function uploadImage(UploadedFile $file, string $column = 'image', bool $deleteOld = true): void
    {
        if ($deleteOld && !empty($this->{$column}) && file_exists(public_path($this->{$column}))) {
            unlink(public_path($this->{$column}));
        }

        $folder = $this->uploadFolderPath();
        $path = $file->store($folder, 'uploads'); // uploads disk → public/uploads

        $this->{$column} = $path;
    }

    protected function uploadFolderPath(): string
    {
        $model = strtolower(class_basename($this));
        $date = now()->format('Y/m');
        return "{$model}s/{$date}";
    }




    // Child model must set this, otherwise slug won't be generated
    protected static $slugSource = null;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (static::$slugSource && empty($model->slug) && !empty($model->{static::$slugSource})) {
                $model->slug = static::generateUniqueSlug($model->{static::$slugSource}, $model);
            }
        });

        static::updating(function ($model) {
            if (static::$slugSource && $model->isDirty(static::$slugSource)) {
                $model->slug = static::generateUniqueSlug($model->{static::$slugSource}, $model);
            }
        });
    }

    protected static function generateUniqueSlug($source, $model)
    {
        $slug = Str::slug($source);
        $originalSlug = $slug;
        $i = 1;

        while (static::where('slug', $slug)->exists()) {  // ✅ Correct
            $slug = "{$originalSlug}-{$i}";
            $i++;
        }

        return $slug;
    }
}
