<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_category_id',
        'name',
        'slug',
        'description',
        'price',
        'sale_price',
        'thumbnail',
        'type',
        'bundle_items',
        'status',
        'target_group',
        'brand',
        'is_featured',
        'is_new',
        'is_on_sale',
        'total_stock',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_new' => 'boolean',
        'is_on_sale' => 'boolean',
        'price' => 'decimal:2',
        'sale_price' => 'decimal:2',
        'total_stock' => 'integer',
    ];

    /**
     * Auto-generate unique slug
     */
    protected static function booted()
    {
        static::creating(function ($product) {
            $baseSlug = Str::slug($product->name);
            $slug = $baseSlug;
            $count = 1;

            while (static::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $count++;
            }

            $product->slug = $slug;
        });

        // Optional: update slug when name changes
        static::updating(function ($product) {
            if ($product->isDirty('name')) {
                $baseSlug = Str::slug($product->name);
                $slug = $baseSlug;
                $count = 1;

                while (static::where('slug', $slug)->where('id', '!=', $product->id)->exists()) {
                    $slug = $baseSlug . '-' . $count++;
                }

                $product->slug = $slug;
            }
        });
    }

    /**
     * Category relation
     */
    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    /**
     * Product images
     */
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    /**
     * Product variations (size, color, etc.)
     */
    public function variations()
    {
        return $this->hasMany(ProductVariation::class);
    }

    /**
     * (Optional future use) tags
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Scope: active products only
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope: featured products
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope: on sale products
     */
    public function scopeOnSale($query)
    {
        return $query->where('is_on_sale', true);
    }

    /**
     * Accessor: final price (sale logic)
     */
    public function getFinalPriceAttribute()
    {
        return $this->sale_price ?? $this->price;
    }

    /**
     * Accessor: in stock check
     */
    public function getInStockAttribute()
    {
        return $this->total_stock > 0;
    }

    /**
     * Eager load (optional performance boost)
     */
    protected $with = [
        'category'
    ];
}
