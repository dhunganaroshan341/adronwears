<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class StoreShippingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'address_line' => $this->filled('address_line')
                ? $this->input('address_line')
                : 'Nepal',

            'city' => $this->filled('city')
                ? $this->input('city')
                : 'Kathmandu',
        ]);
    }

    public function rules(): array
    {
        return [
            'cart_id' => 'nullable|exists:carts,id',
            'product_id' => 'required|exists:products,id',
            'customer_name' => 'nullable|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_email' => 'nullable|email',
            'address_line' => 'required|string',
            'city' => 'required|string',
            'notes' => 'nullable|string',
        ];
    }
}
