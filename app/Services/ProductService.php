<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class ProductService
{
    /*
    |--------------------------------------------------------------------------
    | BASIC PAGINATED PRODUCTS
    |--------------------------------------------------------------------------
    */
    public function getProductsWithCategory(int $perPage = 15)
    {
        return Product::with(['category', 'tags'])
            ->latest()
            ->paginate($perPage);
    }

    /*
    |--------------------------------------------------------------------------
    | FEATURED PRODUCTS
    |--------------------------------------------------------------------------
    */
    public function getFeaturedProducts()
    {
        return Cache::remember('home.featured_products', 600, function () {
            return Product::with('category')
                ->where('is_featured', 1)
                ->latest()
                ->take(10)
                ->get();
        });
    }

    /*
    |--------------------------------------------------------------------------
    | BUNDLES
    |--------------------------------------------------------------------------
    */
    public function getBundles()
    {
        return Cache::remember('home.bundles', 600, function () {
            return Product::with(['category', 'tags'])
                ->where('type', 'bundle')
                ->latest()
                ->get();
        });
    }

    /*
    |--------------------------------------------------------------------------
    | TARGET GROUP PRODUCTS
    |--------------------------------------------------------------------------
    */
    public function getByTargetGroup(string $group, int $limit = 10)
    {
        return Cache::remember("products.group.$group", 600, function () use ($group, $limit) {
            return Product::with(['category', 'tags'])
                ->where('target_group', $group)
                ->latest()
                ->take($limit)
                ->get();
        });
    }

    public function getAllTargetGroups()
    {
        $groups = ['male', 'female', 'unisex', 'kids'];

        $data = [];

        foreach ($groups as $group) {
            $data[$group] = $this->getByTargetGroup($group);
        }

        return $data;
    }

    /*
    |--------------------------------------------------------------------------
    | TAG BASED PRODUCTS
    |--------------------------------------------------------------------------
    */
    public function getByTag(string $tagSlug, int $limit = 10)
    {
        return Cache::remember("products.tag.$tagSlug", 600, function () use ($tagSlug, $limit) {
            return Product::with(['category', 'tags'])
                ->whereHas('tags', function ($q) use ($tagSlug) {
                    $q->where('slug', $tagSlug);
                })
                ->latest()
                ->take($limit)
                ->get();
        });
    }

    public function getHomeTagSections(array $tags)
    {
        $data = [];

        foreach ($tags as $tag) {
            $data[$tag] = $this->getByTag($tag);
        }

        return $data;
    }

    /*
    |--------------------------------------------------------------------------
    | 🔥 MAIN SHOP FILTER (PAGINATED)
    |--------------------------------------------------------------------------
    */
    public function filter(array $filters, int $perPage = 12)
    {
        $query = Product::query()->with(['category', 'tags']);

        // Category filter
        if (!empty($filters['category_id'])) {
            $query->where('product_category_id', $filters['category_id']);
        }

        // Target group
        if (!empty($filters['target_group'])) {
            $query->where('target_group', $filters['target_group']);
        }

        // Featured filter
        if (!empty($filters['is_featured'])) {
            $query->where('is_featured', (bool) $filters['is_featured']);
        }

        // Price range
        if (!empty($filters['min_price'])) {
            $query->where('price', '>=', $filters['min_price']);
        }

        if (!empty($filters['max_price'])) {
            $query->where('price', '<=', $filters['max_price']);
        }

        // Tags filter
        if (!empty($filters['tags']) && is_array($filters['tags'])) {
            $query->whereHas('tags', function ($q) use ($filters) {
                $q->whereIn('slug', $filters['tags']);
            });
        }

        // Search
        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('name', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('description', 'like', '%' . $filters['search'] . '%');
            });
        }

        // Sorting
        if (!empty($filters['sort'])) {
            match ($filters['sort']) {
                'price_low' => $query->orderBy('price', 'asc'),
                'price_high' => $query->orderBy('price', 'desc'),
                'latest' => $query->latest(),
                default => $query->latest(),
            };
        } else {
            $query->latest();
        }

        return $query->paginate($perPage)->withQueryString();
    }


    public function getProductDetails(string $slug)
    {
        return Product::with([
            'category',
            'variations',
            'tags',
            'images'
        ])->where('slug', $slug)->firstOrFail();
    }


    public function getRelatedProducts(Product $product, int $limit = 8)
    {
        return Product::with(['category', 'images', 'tags'])
            ->where('id', '!=', $product->id)
            ->where(function ($query) use ($product) {
                // same category
                $query->where('product_category_id', $product->product_category_id);

                // OR same tags (optional stronger relevance)
                $query->orWhereHas('tags', function ($q) use ($product) {
                    $q->whereIn('tags.id', $product->tags->pluck('id'));
                });
            })
            ->latest()
            ->take($limit)
            ->get();
    }
}
