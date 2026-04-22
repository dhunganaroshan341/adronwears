<?php

namespace App\Domain\Order\Resolvers;


use App\Models\Cart;
use App\Models\Product;

class OrderItemResolver
{
    public function resolve(array $data): array
    {
        // From cart
        if (!empty($data['cart_id'])) {
            $cart = Cart::with('items.product')->findOrFail($data['cart_id']);

            return $cart->items->map(function ($item) {
                return [
                    'name' => $item->product->name,
                    'qty' => $item->quantity,
                    'price' => $item->product->price,
                ];
            })->toArray();
        }

        // Single product
        if (!empty($data['product_id'])) {
            $product = Product::findOrFail($data['product_id']);

            return [[
                'name' => $product->name,
                'qty' => 1,
                'price' => $product->price,
            ]];
        }

        throw new \Exception('No valid order source');
    }
}
