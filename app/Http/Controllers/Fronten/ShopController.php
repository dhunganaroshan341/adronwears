<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    //
    public function show(Product $product)
    {
        $product = $product->with('images', 'category', 'brand')->firstOrFail();
        return view('Frontend.Pages.shop-single', compact('product'));
    }
}
