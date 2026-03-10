<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\StatusEnum;

class ProductCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('product_categories', 'slug')
                    ->ignore($this->route('id')),
            ],

            'parent_id' => [
                'nullable',
                'integer',
                'exists:product_categories,id',
            ],

            'status' => [
                'required',
                Rule::in(StatusEnum::values()),
            ],
        ];
    }
}
