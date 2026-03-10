<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;



class TeamRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // allow all for now, adjust as needed
    }

    public function rules(): array
    {
        return [
            'name'      => 'required|string|max:255',
            'position'  => 'required|string|max:255',
            'photo'     => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'facebook'  => 'nullable|url|max:255',
            'twitter'   => 'nullable|url|max:255',
            'linkedin'  => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'order'     => 'nullable|integer|min:0',
        ];
    }
}

