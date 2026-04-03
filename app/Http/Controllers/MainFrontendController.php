<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Services\HomeService;

class MainFrontendController extends Controller
{
    public function index(HomeService $homeService)
    {
        dd(collect($homeService->getHomeData())->toArray());
        return view('Frontend.Pages.index', $homeService->getHomeData());
    }
    public function about()
    {
        return view('Frontend.Pages.about');
    }
    public function shop()
    {
        $products = Product::latest()->take(8)->get();
        $categories = ProductCategory::whereNull('parent_id')
            ->with([
                'children' => function ($q) {
                    $q->withCount('products');
                }
            ])
            ->withCount('products')
            ->get();
        // dd($categories->toArray());
        return view('Frontend.Pages.shop', compact('products', 'categories'));
    }
    public function productDetail()
    {
        return view('Frontend.Pages.shop-single');
    }
    public function contact()
    {
        return view('Frontend.Pages.contact');
    }
}
