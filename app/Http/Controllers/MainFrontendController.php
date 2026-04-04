<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Services\HomeService;
use App\Services\ProductService;

class MainFrontendController extends Controller
{
    public function index(HomeService $homeService)
    {
        // dd(collect($homeService->getHomeData())->toArray());
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

    public function shopByCategory(ProductCategory $category)
    {
        $products = Product::whereHas('category', function ($q) use ($category) {
            $q->where('id', $category->id)
                ->orWhere('parent_id', $category->id); // include subcategory products too
        })
            ->latest()
            ->paginate(12);

        $categories = ProductCategory::whereNull('parent_id')
            ->with([
                'children' => function ($q) {
                    $q->withCount('products');
                }
            ])
            ->withCount('products')
            ->get();

        return view('Frontend.Pages.shop', compact('products', 'categories', 'category'));
    }
    // public function productDetail()
    // {
    //     return view('Frontend.Pages.shop-single');
    // }

    public function ProductDetail($slug, ProductService $productService)
    {
        $product = $productService->getProductDetails($slug);

        $related = $productService->getRelatedProducts($product);
        // dd($product->toArray());
        // dd($related->toArray());
        return view('Frontend.Pages.shop-single', compact('product'));
    }
}
