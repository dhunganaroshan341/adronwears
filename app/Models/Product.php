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
        'product_code',
        'name',
        'slug',
        'brand_id',
        'description',
        'price',
        'sale_price',
        'thumbnail',
        'type',
        'bundle_items',
        'status',
        'target_group',
        'brand_name',
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
        'bundle_items' => 'array',
    ];

    /**
     * Model boot logic.
     */
    protected static function booted(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Creating
        |--------------------------------------------------------------------------
        */

        static::creating(function (Product $product) {

            // Generate product code automatically.
            if (empty($product->product_code)) {
                $product->product_code = static::generateProductCode(
                    $product->name
                );
            }

            // Generate unique slug automatically.
            if (empty($product->slug)) {
                $product->slug = static::generateUniqueSlug(
                    $product->name
                );
            }
        });

        /*
        |--------------------------------------------------------------------------
        | Updating
        |--------------------------------------------------------------------------
        */

        static::updating(function (Product $product) {

            // Regenerate slug only when product name changes.
            if ($product->isDirty('name')) {
                $product->slug = static::generateUniqueSlug(
                    $product->name,
                    $product->id
                );
            }

            /*
             * Product code is intentionally NOT regenerated when
             * the product name changes.
             *
             * Example:
             *
             * NIKE-AIR-MAX-260823-001
             *
             * remains the same even if the product name changes.
             */
            if (empty($product->product_code)) {
                $product->product_code = static::generateProductCode(
                    $product->name,
                    $product->id
                );
            }
        });
    }

    /**
     * Generate a unique product code.
     *
     * Format:
     *
     * PRODUCT-NAME-YYMMDD-001
     *
     * Examples:
     *
     * NIKE-AIR-MAX-260823-001
     * NIKE-AIR-MAX-260823-002
     * LEVIS-JEANS-260823-001
     */
    protected static function generateProductCode(
        string $name,
        ?int $ignoreId = null
    ): string {
        $date = now()->format('ymd');

        // Convert product name to a clean uppercase code.
        $baseCode = Str::upper(
            Str::slug($name, '-')
        );

        // Keep the base name reasonably short.
        $baseCode = Str::limit(
            $baseCode,
            20,
            ''
        );

        // Fallback if name produces an empty slug.
        if (empty($baseCode)) {
            $baseCode = 'PRODUCT';
        }

        /*
         * Start with the number of products created today + 1.
         *
         * This avoids starting from 001 every time.
         */
        $sequence = static::whereDate(
            'created_at',
            today()
        )->count() + 1;

        do {
            $code = sprintf(
                '%s-%s-%03d',
                $baseCode,
                $date,
                $sequence
            );

            $query = static::where(
                'product_code',
                $code
            );

            if ($ignoreId !== null) {
                $query->where(
                    'id',
                    '!=',
                    $ignoreId
                );
            }

            $sequence++;

        } while ($query->exists());

        return $code;
    }

    /**
     * Generate a unique slug.
     *
     * Examples:
     *
     * nike-air-max
     * nike-air-max-1
     * nike-air-max-2
     */
    protected static function generateUniqueSlug(
        string $name,
        ?int $ignoreId = null
    ): string {
        $baseSlug = Str::slug($name);

        if (empty($baseSlug)) {
            $baseSlug = 'product';
        }

        $slug = $baseSlug;
        $count = 1;

        while (true) {
            $query = static::where(
                'slug',
                $slug
            );

            if ($ignoreId !== null) {
                $query->where(
                    'id',
                    '!=',
                    $ignoreId
                );
            }

            if (!$query->exists()) {
                break;
            }

            $slug = $baseSlug . '-' . $count;

            $count++;
        }

        return $slug;
    }

    /**
     * Category relation.
     */
    public function category()
    {
        return $this->belongsTo(
            ProductCategory::class,
            'product_category_id'
        );
    }

    /**
     * Brand relation.
     */
    public function brand()
    {
        return $this->belongsTo(
            Brand::class,
            'brand_id'
        );
    }

    /**
     * Product images.
     */
    public function images()
    {
        return $this->hasMany(
            ProductImage::class
        );
    }

    /**
     * Product variations.
     */
    public function variations()
    {
        return $this->hasMany(
            ProductVariation::class
        );
    }

    /**
     * Product tags.
     */
    public function tags()
    {
        return $this->belongsToMany(
            Tag::class
        );
    }

    /**
     * Active products.
     */
    public function scopeActive($query)
    {
        return $query->where(
            'status',
            'active'
        );
    }

    /**
     * Featured products.
     */
    public function scopeFeatured($query)
    {
        return $query->where(
            'is_featured',
            true
        );
    }

    /**
     * Products currently on sale.
     */
    public function scopeOnSale($query)
    {
        return $query->where(
            'is_on_sale',
            true
        );
    }

    /**
     * Final selling price.
     */
    public function getFinalPriceAttribute()
    {
        return $this->sale_price ?? $this->price;
    }

    /**
     * Thumbnail URL.
     */
    public function getThumbnailAttribute($value)
    {
        if (!$value) {
            return null;
        }

        return asset(
            'uploads/' . ltrim($value, '/')
        );
    }

    /**
     * Check whether product is in stock.
     */
    public function getInStockAttribute()
    {
        return $this->total_stock > 0;
    }

    /**
     * Eager loaded relationships.
     */
    protected $with = [
        'category',
    ];

    /**
     * Use slug for route model binding.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
