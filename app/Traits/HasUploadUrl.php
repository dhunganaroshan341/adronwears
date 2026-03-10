<?php
namespace App\Traits;

trait HasUploadUrl
{
    public function getImageUrlAttribute()
    {
        // Define the column name that holds the file path, fallback to 'image_path'
        $pathColumn = property_exists($this, 'uploadPathColumn') ? $this->uploadPathColumn : 'image_path';

        $path = $this->{$pathColumn};

        if (!$path) {
            return null;
        }

        // Assuming your uploads folder is 'uploads'
        return asset('uploads/' . $path);
    }
    public function getUploadUrl(string $column = 'image_path')
    {
        $path = $this->{$column} ?? null;
        if (!$path) return null;
        return asset('uploads/' . $path);
    }
}
