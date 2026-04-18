<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductFilterService
{
    public function getFilteredProducts(Request $request)
    {
        $query = Product::query(); // already eager loads category

        // 🔍 Search (name / brand)
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('brand', 'like', "%$search%");
            });
        }

        // 📂 Category
        if ($request->filled('category_id')) {
            $query->where('product_category_id', $request->category_id);
        }

        // 🔄 Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // 🎯 Target group
        if ($request->filled('target_group')) {
            $query->where('target_group', $request->target_group);
        }

        // 🏷️ Type (single / bundle)
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // ⭐ Flags
        if ($request->filled('is_featured')) {
            $query->where('is_featured', $request->is_featured);
        }

        if ($request->filled('is_new')) {
            $query->where('is_new', $request->is_new);
        }

        if ($request->filled('is_on_sale')) {
            $query->where('is_on_sale', $request->is_on_sale);
        }

        // 💰 Price range
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // 📦 Stock filter
        if ($request->filled('stock')) {
            if ($request->stock === 'in') {
                $query->where('total_stock', '>', 0);
            } elseif ($request->stock === 'out') {
                $query->where('total_stock', '<=', 0);
            }
        }

        // 🔃 Sorting
        switch ($request->sort) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;

            case 'price_high':
                $query->orderBy('price', 'desc');
                break;

            case 'oldest':
                $query->oldest();
                break;

            default:
                $query->latest();
                break;
        }

        return $query->paginate(15)->withQueryString();
    }
}
