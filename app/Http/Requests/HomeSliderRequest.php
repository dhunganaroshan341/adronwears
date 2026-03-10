<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HomeSliderRequest extends FormRequest
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
            'image'=>$this->route('id') ? 'nullable|image' : 'required|image',
        ];
    }


    public function messages(){
        return [
            'title.required'=>'Please Enter the Title Name',
            'title.min'=>'Title must be at least 3 character long',
            'image.required'=>'Please Insert Image',
            'image.image'=>'Image must be the type of png,jpeg,jpg',
            'image.dimensions'=>'Image must be of min 1300 px and max 500 px'
        ];
    }
}
