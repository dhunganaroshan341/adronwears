<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GalleryMediaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'gallery_album_id' => 'required|exists:gallery_albums,id',
            'status' => 'required|in:Active,Inactive',
            'media_path' => 'required|string|max:255',
            'media_path.*' => 'mimes:png,jpeg,jpg,webp',


        ];
    }

    public function messages(): array
    {
        return [
            'gallery_album_id.required' => 'Please select an album for this media.',
            'gallery_album_id.exists' => 'The selected album does not exist.',
            'media_path.*.mimes'=>'Image should be of : png,jpeg,jpg,webp',
            'status.required' => 'The media status is required.',
            'status.in' => 'The status must be either Active or Inactive.',
        ];
    }
}
