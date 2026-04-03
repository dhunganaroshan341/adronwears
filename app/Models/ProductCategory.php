<?php

namespace App\Models;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductCategory extends BaseModel
{
    use HasFactory;

    /**
     * BaseModel will auto-handle slug from "name"
     */
    protected static $slugSource = 'name';

    protected $fillable = [
        'name',
        'slug',
        'parent_id',
        'status',
        'sort_order',
        'is_featured',
    ];

    protected $appends = ['parent_category'];

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'product_category_id');
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    public function getParentCategoryAttribute()
    {
        return $this->parent?->name ?? '-';
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    public function scopeActive($query)
    {
        return $query->where('status', StatusEnum::ACTIVE->value);
    }
}
