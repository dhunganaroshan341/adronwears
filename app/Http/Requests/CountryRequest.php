<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CountryRequest extends FormRequest
{
    public function authorize()
    {
        // Set to true if all users can send this request, or add your auth logic here
        return true;
    }

    public function rules()
    {
        $countryId = $this->route('country') ? $this->route('country')->id : null;

        return [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:countries,slug,' . $countryId,
            'description' => 'nullable|string',
        ];
    }
}
