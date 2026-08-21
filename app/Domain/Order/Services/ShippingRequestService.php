<?php

namespace App\Domain\Order\Services;

use App\Models\ShippingRequest;
use Illuminate\Support\Facades\DB;

class ShippingRequestService
{
    public function create(array $data): ShippingRequest
    {
        return DB::transaction(function () use ($data) {

            return ShippingRequest::create([
                'cart_id' => $data['cart_id'] ?? null,
                'product_id' => $data['product_id'],
                'user_id' => auth()->id(),
                'customer_name' => $data['customer_name'] ?? auth()->user()?->name,
                'customer_phone' => $data['customer_phone'],
                'customer_email' => $data['customer_email'] ?? auth()->user()?->email,
                'address_line' => $data['address_line'],
                'city' => $data['city'],
                'notes' => $data['notes'] ?? null,
            ]);
        });
    }
}
