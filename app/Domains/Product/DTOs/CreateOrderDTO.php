<?php

namespace App\Domains\Order\DTOs;

class CreateOrderDTO
{
    public function __construct(
        public readonly ?int $cart_id,
        public readonly ?int $product_id,
        public readonly ?int $user_id,
        public readonly string $customer_name,
        public readonly string $customer_phone,
        public readonly string $address_line,
        public readonly string $city,
        public readonly ?string $email = null,
        public readonly ?string $notes = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            cart_id: $data['cart_id'] ?? null,
            product_id: $data['product_id'] ?? null,
            user_id: auth()->id(),
            customer_name: $data['customer_name'] ?? auth()->user()?->name ?? '',
            customer_phone: $data['customer_phone'],
            address_line: $data['address_line'],
            city: $data['city'],
            email: $data['customer_email'] ?? auth()->user()?->email ?? null,
            notes: $data['notes'] ?? null,
        );
    }
}
