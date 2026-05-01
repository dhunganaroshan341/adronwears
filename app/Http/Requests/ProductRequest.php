<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {


        return [
            /*
            |--------------------------------------------------------------------------
            | CORE RELATION
            |--------------------------------------------------------------------------
            */
            'product_category_id' => [
                'required',
                'integer',
                'exists:product_categories,id',
            ],

            /*
            |--------------------------------------------------------------------------
            | BASIC INFO
            |--------------------------------------------------------------------------
            */
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            /*
            |--------------------------------------------------------------------------
            | PRICING
            |--------------------------------------------------------------------------
            */
            'price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'sale_price' => [
                'nullable',
                'numeric',
                'lt:price',
                'min:0',
            ],

            /*
            |--------------------------------------------------------------------------
            | MEDIA
            |--------------------------------------------------------------------------
            */
            'thumbnail' => [
                'nullable',
                'string',
                'max:255',
            ],

            'images' => [
                'nullable',
                'array',
            ],

            'images.*' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            /*
            |--------------------------------------------------------------------------
            | FLAGS
            |--------------------------------------------------------------------------
            */
            'status' => [
                'required',
                Rule::in(['active', 'inactive']),
            ],

            'target_group' => [
                'nullable',
                Rule::in(['male', 'female', 'unisex']),
            ],

            'is_featured' => ['nullable', 'boolean'],
            'is_new' => ['nullable', 'boolean'],
            'is_on_sale' => ['nullable', 'boolean'],

            /*
            |--------------------------------------------------------------------------
            | INVENTORY
            |--------------------------------------------------------------------------
            */
            'total_stock' => [
                'nullable',
                'integer',
                'min:0',
            ],

            /*
            |--------------------------------------------------------------------------
            | BRAND
            |--------------------------------------------------------------------------
            */
            'brand' => [
                'nullable',
                'string',
                'max:255',
            ],

            /*
            |--------------------------------------------------------------------------
            | 🏷️ TAGS (NEW)
            |--------------------------------------------------------------------------
            |
            | Expecting:
            | tags: [1,2,3] OR ["shirt", "summer"]
            |
            */
            'tags' => [
                'nullable',
                'array',
            ],

            'tags.*' => [
                'integer',
                'exists:tags,id',
            ],

            /*
            |--------------------------------------------------------------------------
            | 🧩 ATTRIBUTES (JSON FLEX SYSTEM)
            |--------------------------------------------------------------------------
            |
            | Example:
            | {
            |   "color": "red",
            |   "size": "XL",
            |   "material": "cotton"
            | }
            |
            */
            'attributes' => [
                'nullable',
                'array',
            ],
        ];
    }
}
