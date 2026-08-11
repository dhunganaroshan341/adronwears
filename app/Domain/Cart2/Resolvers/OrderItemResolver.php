<?php

namespace App\Domain\Order\Resolvers;

use App\Domain\Order\DTOs\CreateOrderDTO;
use App\Models\Cart;
use App\Models\Product;

class OrderItemResolver
{
    public function resolve(CreateOrderDTO $dto): array
    {
        // From cart
        if (!empty($dto->cart_id)) {

            $cart = Cart::with('items.product')
                ->findOrFail($dto->cart_id);

            return $cart->items->map(function ($item) {

                return [
                    'name' => $item->product->name,
                    'qty' => $item->quantity,
                    'price' => $item->product->price,
                ];
            })->toArray();
        }

        // Single product
        if (!empty($dto->product_id)) {

            $product = Product::findOrFail($dto->product_id);

            return [[
                'name' => $product->name,
                'qty' => 1,
                'price' => $product->price,
            ]];
        }

        throw new \Exception('No valid order source');
    }
}
