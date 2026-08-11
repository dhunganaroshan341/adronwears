<?php

namespace App\Services;

use App\Models\Product;
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
      "home.categories.featured.v2.{$limit}",
        now()->addHours(6),
        function () use ($limit) {

            $products = Product::query()
                ->where('type', 'category_of_the_month')
                // ->whereNotNull('thumbnail')
                ->with('category:id,name,slug')
                ->latest()
                ->get(['id', 'product_category_id', 'thumbnail']);

            $categories = $products
                ->unique('product_category_id')
                ->take($limit)
              ->map(function ($product) {

    dd([
        'raw' => $product->getRawOriginal('thumbnail'),
        'attribute' => $product->thumbnail,
    ]);

    return [
        'id' => $product->category->id,
        'name' => $product->category->name,
        'slug' => $product->category->slug,
        'thumbnail_image' => $product->thumbnail,
    ];
})
                ->values();
            return $categories;
        }
    );
}
}
