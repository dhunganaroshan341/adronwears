<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductDisplayService
{
    public function __construct()
    {
        throw new \Exception('Not implemented');
    }
    public function getProductsWithCategory()
    {
        return Product::with('category')->latest()->paginate(15);
    }

    public function getProductCategory()
    {
        return Product::with('category')->latest()->paginate(15);
    }
}
