<?php

namespace App\Domain\Order\Services;

use App\Domain\Order\DTOs\CreateShippingRequestDTO;
use App\Models\ShippingRequest;

class ShippingRequestService
{
    public function create(CreateShippingRequestDTO $dto): ShippingRequest
    {
        return ShippingRequest::create([
            'cart_id' => $dto->cart_id,
            'product_id' => $dto->product_id,
            'user_id' => $dto->user_id,
            'customer_name' => $dto->customer_name,
            'customer_phone' => $dto->customer_phone,
            'customer_email' => $dto->email,
            'address_line' => $dto->address_line,
            'city' => $dto->city,
            'notes' => $dto->notes,
        ]);
    }
}
