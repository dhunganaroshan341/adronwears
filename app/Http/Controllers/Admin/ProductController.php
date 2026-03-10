<?php

namespace App\Http\Controllers\Admin;

use App\Enums\StatusEnum;
use App\Exports\ProductsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Imports\ProductsImport;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Services\ProductExcelService;
use Illuminate\Http\Request as HttpRequest;
use Maatwebsite\Excel\Excel;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(15);
        return view('Admin.pages.products.index', compact('products'));
    }

    public function create()
    {
        $categories = ProductCategory::where('status', StatusEnum::ACTIVE)->get();

        return view('Admin.pages.products.create', compact('categories'));
    }

    public function store(ProductRequest $request)
    {
        $data = $request->validated();
        dd($data);
        // Thumbnail
        $data['thumbnail'] = $this->handleSingleMedia(
            $request,
            'thumbnail',
            null,
            '/products'
        );

        $product = Product::create($data);

        // Multiple images
        $images = $this->handleMultipleMedia(
            $request,
            'images',
            '/products/gallery'
        );

        foreach ($images as $path) {
            $product->images()->create([
                'image_path' => $path,
            ]);
        }

        return back()->with(
            'success',
            $product->name . ' created successfully'
        );
    }
    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->validated();

        // Update thumbnail
        $data['thumbnail'] = $this->handleSingleMedia(
            $request,
            'thumbnail',
            $product->thumbnail,
            '/products'
        );

        $product->update($data);

        // Append new images (do NOT delete old ones here)
        $images = $this->handleMultipleMedia(
            $request,
            'images',
            '/  products/gallery'
        );

        foreach ($images as $path) {
            $product->images()->create([
                'image_path' => $path,
            ]);
        }

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product updated successfully');
    }


    public function edit(Product $product)
    {
        $product->load('images');
        // dd($product);
        $categories = ProductCategory::where('status', StatusEnum::ACTIVE)->get();
        return view('Admin.pages.products.edit', compact('product', 'categories'));
    }



    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product deleted successfully');
    }

    public function export()
    {
        return Excel::download(new ProductsExport, 'products.xlsx');
    }

    public function import(HttpRequest $request, ProductExcelService $service)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        Excel::import(
            new ProductsImport($service),
            $request->file('file')
        );

        return back()->with('success', 'Products imported successfully');
    }
}
