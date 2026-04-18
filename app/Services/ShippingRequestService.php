<?php

namespace App\Services;

use App\Models\ShippingRequest;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ShippingRequestService
{

    public function getFilteredRequests(Request $request)
    {
        $query = ShippingRequest::query();

        // 🔍 Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // 🔍 Date range
        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        // 🔍 Search
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('customer_name', 'like', "%$search%")
                    ->orWhere('customer_phone', 'like', "%$search%")
                    ->orWhere('customer_email', 'like', "%$search%");
            });
        }

        // 🔍 City
        if ($request->filled('city')) {
            $query->where('city', $request->city);
        }

        // 🔍 User type
        if ($request->filled('user_type')) {
            if ($request->user_type === 'guest') {
                $query->whereNull('user_id');
            } elseif ($request->user_type === 'registered') {
                $query->whereNotNull('user_id');
            }
        }

        // 🔃 Sorting
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'oldest':
                    $query->oldest();
                    break;
                default:
                    $query->latest();
                    break;
            }
        } else {
            $query->latest();
        }

        return $query->paginate(15)->withQueryString();
    }
    public function create(array $data): ShippingRequest
    {
        // Validate cart existence
        $cart = Cart::findOrFail($data['cart_id']);

        // Attach user if logged in
        if (Auth::check()) {
            $data['user_id'] = Auth::id();

            // Optional: auto-fill user info
            $data['customer_name'] = $data['customer_name'] ?? Auth::user()->name;
            $data['customer_email'] = $data['customer_email'] ?? Auth::user()->email;
        }

        // Create shipping request
        return ShippingRequest::create($data);
    }

    public function update(ShippingRequest $shippingRequest, array $data): ShippingRequest
    {
        $shippingRequest->update($data);
        return $shippingRequest;
    }

    public function delete(ShippingRequest $shippingRequest): void
    {
        $shippingRequest->delete();
    }
}
