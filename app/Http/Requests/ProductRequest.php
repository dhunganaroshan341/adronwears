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
        // dd($this->all());
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
                'image',
                'mimes:jpg,jpeg,png,webp,pdf,JPG,JPEG,PNG,WEBP,PDF',
                'max:2048',
            ],

            'images' => [
                'nullable',
                'array',
            ],

            'images.*' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp,pdf,JPG,JPEG,PNG,WEBP,PDF',
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
            'type' => [
                'nullable',
                Rule::in(['simple', 'bundle','featured','category_of_the_month']),
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
            'brand_id' => [
                'integer',
                'exists:brands,id',
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
