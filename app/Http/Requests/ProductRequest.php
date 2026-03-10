<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // dd($this->request->all());
        return [
            'product_category_id' => ['required', 'exists:product_categories,id'],
            'name'                => ['required', 'string', 'max:255'],
            'description'         => ['nullable', 'string'],
            'price'               => ['required', 'numeric', 'min:0'],
            'sale_price'          => ['nullable', 'numeric', 'lt:price'],
            'thumbnail'           => ['nullable', 'string'],
            'status'              => ['required', 'in:active,inactive'],

            'images'   => ['nullable', 'array'],
            'images.*' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],

        ];
    }
}
