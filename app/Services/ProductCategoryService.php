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
}
