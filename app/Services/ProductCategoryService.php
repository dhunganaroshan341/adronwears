<?php

namespace App\Services;

use App\Models\ProductCategory;
use Illuminate\Support\Facades\Cache;

class ProductCategoryService
{
    public function getCategories()
    {
        return Cache::remember('home.categories', 60 * 10, function () {
            return ProductCategory::with('children')
                ->whereNull('parent_id')
                ->get();
        });
    }


    public function getHomeCategories(int $limit = 10)
    {
        return Cache::remember(
            'home.categories.featured',
            now()->addMinutes(30),
            function () use ($limit) {

                $categories = ProductCategory::query()
                    ->select('product_categories.id', 'product_categories.name', 'product_categories.slug')

                    // 1. shipping request count
                    ->selectSub(function ($query) {
                        $query->from('shipping_requests')
                            ->join('carts', 'carts.id', '=', 'shipping_requests.cart_id')
                            ->join('cart_items', 'cart_items.cart_id', '=', 'carts.id')
                            ->join('products', 'products.id', '=', 'cart_items.product_id')
                            ->whereColumn('products.product_category_id', 'product_categories.id')
                            ->selectRaw('COUNT(shipping_requests.id)');
                    }, 'shipping_requests_count')

                    // 2. total products count
                    ->withCount('products')

                    // 3. latest product date
                    ->selectSub(function ($query) {
                        $query->from('products')
                            ->whereColumn('products.product_category_id', 'product_categories.id')
                            ->selectRaw('MAX(created_at)');
                    }, 'latest_product_at')

                    ->with(['products' => function ($q) {
                        $q->select('id', 'product_category_id', 'thumbnail')
                            ->whereNotNull('thumbnail')
                            ->latest()
                            ->take(1);
                    }])

                    ->orderByDesc('shipping_requests_count')
                    ->orderByDesc('products_count')
                    ->orderByDesc('latest_product_at')
                    ->take($limit)
                    ->get();

                return $categories->map(function ($category) {

                    $thumbnail = optional($category->products->first())->thumbnail;

                    return [
                        'id' => $category->id,
                        'name' => $category->name,
                        'slug' => $category->slug,
                        'products_count' => $category->products_count,
                        'shipping_requests_count' => (int) $category->shipping_requests_count,
                        'thumbnail_image' => $thumbnail
                            ? asset('storage/' . $thumbnail)
                            : null,
                    ];
                })->values();
            }
        );
    }
}
