<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCategoryRequest;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function index()
    {
        // Get paginated categories
        $categories = ProductCategory::with('parent')->latest()->paginate(10);

        // Get parent categories for modal dropdown
        $parentCategories = ProductCategory::whereNull('parent_id')->get();

        return view('Admin.pages.ProductCategory.index', compact('categories', 'parentCategories'));
    }

    public function store(ProductCategoryRequest $request)
    {
        $data = $request->validated();

        // Generate unique slug if not provided
        $data['slug'] = ProductCategory::generateUniqueSlug(
            $data['name'],
            $data['parent_id'] ?? null
        );

        ProductCategory::create($data);

        return redirect()->route('admin.product-categories.index')
            ->with('success', 'Category created successfully.');
    }

    public function update(ProductCategoryRequest $request, ProductCategory $productCategory)
    {
        $data = $request->validated();

        // If name changed, regenerate slug
        if ($productCategory->name !== $data['name']) {
            $data['slug'] = ProductCategory::generateUniqueSlug(
                $data['name'],
                $data['parent_id'] ?? null
            );
        }

        $productCategory->update($data);

        return redirect()->route('admin.product-categories.index')
            ->with('success', 'Category updated successfully.');
    }


    public function destroy(ProductCategory $productCategory)
    {
        $productCategory->delete();

        return redirect()->route('admin.product-categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}
