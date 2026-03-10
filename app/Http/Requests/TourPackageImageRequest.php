<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TourPackageImageRequest extends FormRequest
{
    public function authorize()
    {
        // Adjust authorization logic as needed
        return true;
    }

    public function rules()
    {
        return [
            'tour_package_id' => 'required|exists:tour_packages,id',
            'image_path' => 'required|image|max:5120', // max 5MB, validates jpg/png/gif etc.
            'caption' => 'nullable|string|max:255',
            'is_featured' => 'nullable|boolean',
        ];
    }
}
