<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CallToActionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'description' => 'required|string|max:1000',
            // 'image' => 'required|string',
            'title' => 'required|string',
            'sub_heading' => 'nullable|string',
            'iframe' => 'nullable|string',
            // 'page' => 'required|string',
            'link'=>'nullable|string',
        ];
    }
}
