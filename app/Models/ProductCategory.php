<?php

namespace App\Models;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class ProductCategory extends BaseModel
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'parent_id', 'status'];

    protected $appends = ['parent_category'];

    // Parent category (self relation)
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    // Accessor for parent name
    public function getParentCategoryAttribute()
    {
        return $this->parent?->name ?? '-';
    }




    // Automatically generate slug before saving
    protected static function booted()
    {
        static::creating(function ($category) {
            $category->slug = Str::slug($category->name);
        });

        static::updating(function ($category) {
            $category->slug = Str::slug($category->name);
        });
    }

    public function getActiveScope($query)
    {
        return $query->where('status', StatusEnum::ACTIVE);
    }
}
