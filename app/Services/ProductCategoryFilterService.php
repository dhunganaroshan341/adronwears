<?php

namespace App\Services;

use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryFilterService
{
    public function getFilteredCategories(Request $request)
    {
        $query = ProductCategory::with('parent');

        // 🔍 Search (name / slug)
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('slug', 'like', "%$search%");
            });
        }

        // 📂 Parent filter
        if ($request->filled('parent_id')) {
            if ($request->parent_id === 'none') {
                $query->whereNull('parent_id');
            } else {
                $query->where('parent_id', $request->parent_id);
            }
        }

        // 🔄 Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // ⭐ Featured filter
        if ($request->filled('is_featured')) {
            $query->where('is_featured', $request->is_featured);
        }

        // 🔃 Sorting
        switch ($request->sort) {
            case 'oldest':
                $query->oldest();
                break;

            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;

            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;

            default:
                $query->latest();
                break;
        }

        return $query->paginate(10)->withQueryString();
    }

    /**
     * Parent categories for dropdowns/modals
     */
    public function getParentCategories()
    {
        return ProductCategory::whereNull('parent_id')->get();
    }
}
