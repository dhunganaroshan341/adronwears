<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TourPackageVideoRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust as needed
    }

    public function rules()
    {
        return [
            'tour_package_id' => 'required|exists:tour_packages,id',
            'title' => 'nullable|string|max:255',
            'iframe_embed_code' => 'required|string', // Could add URL or iframe validation if needed
        ];
    }
}
