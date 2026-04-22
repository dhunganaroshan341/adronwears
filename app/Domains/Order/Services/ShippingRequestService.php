<?php

namespace App\Domain\Order\Services;

use App\Domains\Order\DTOs\CreateOrderDTO;
use App\Models\ShippingRequest;
use Illuminate\Support\Facades\DB;

class ShippingRequestService
{
    public function create(CreateOrderDTO $dto): ShippingRequest
    {
        return DB::transaction(function () use ($dto) {

            return ShippingRequest::create([
                'cart_id' => $dto->cart_id,
                'user_id' => $dto->user_id,
                'customer_name' => $dto->customer_name,
                'customer_phone' => $dto->customer_phone,
                'customer_email' => $dto->email,
                'address_line' => $dto->address_line,
                'city' => $dto->city,
                'notes' => $dto->notes,
            ]);
        });
    }
}
