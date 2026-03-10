<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\FormRequest;

class NoticeRequest extends FormRequest
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
            'title'=>'required|min:3',
            'url'=>'nullable|string',
            'description'=>'nullable',
            'image'=>Route::currentRouteName() == 'notice.store' ? ['required','mimes:png,jpg,jpeg'] : ['mimes:png,jpg,jpeg']
        ];
    }


    public function messages()
    {
        return [
            'title.required'=>'Please enter the title',
            'title.min'=>'Please enter minimum 3 digits',
            'image.required'=>'Please insert the image',
            'image.mimes'=>'Image must be a type of jpg, png or jpeg'
        ];
    }
}
