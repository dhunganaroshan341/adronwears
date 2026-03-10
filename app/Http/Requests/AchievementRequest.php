<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AchievementRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // allow all for admin
    }

    public function rules(): array
    {
        return [
            'title'       => 'required|string|max:255',
            'count'       => 'required|integer|min:0',
            'icon_class'  => 'required|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'nullable|in:Active,Inactive'
        ];
    }
}
