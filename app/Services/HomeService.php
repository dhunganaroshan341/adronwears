<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\HomeSlide;
use Illuminate\Support\Facades\Cache;

class HomeService
{
    public function getBannerSliders()
    {
        return Cache::remember('home.banner_sliders', 60 * 10, function () {
            return HomeSlide::latest()->get();
        });
    }

    public function getFeaturedProducts()
    {
        return Cache::remember('home.featured_products', 60 * 10, function () {
            return Product::where('is_featured', 1)
                ->latest()
                ->take(10)
                ->get();
        });
    }

    public function getCategories()
    {
        return Cache::remember('home.categories', 60 * 10, function () {
            return ProductCategory::with('children')
                ->whereNull('parent_id')
                ->get();
        });
    }

    public function getHomeData()
    {
        return [
            'bannerSliders'    => $this->getBannerSliders(),
            'featuredProducts' => $this->getFeaturedProducts(),
            'categories'       => $this->getCategories(),
        ];
    }
}
