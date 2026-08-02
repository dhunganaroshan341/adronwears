<?php

namespace App\Services;

use App\Models\HomeSlide;
use Illuminate\Support\Facades\Cache;

class HomeService
{
    protected $productService;
    protected $categoryService;

    public function __construct(
        ProductService $productService,
        ProductCategoryService $categoryService
    ) {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }

    public function getBannerSliders()
    {
        return Cache::remember('home.banner_sliders', 60 * 10, function () {
            return HomeSlide::latest()->get();
        });
    }

    public function getHomeData()
    {
        // dd($this->categoryService->getHomeCategories());
        return [
            'bannerSliders'    => $this->getBannerSliders(),
            'featuredProducts' => $this->productService->getFeaturedProducts(),
            'categories'       => $this->categoryService->getHomeCategories(),
            'bundles'          => $this->productService->getBundles(),
        ];
    }
}
