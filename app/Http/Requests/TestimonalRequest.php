<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestimonalRequest extends FormRequest
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
            'name'=>'required|min:3',
            'address'=>'required',
            'designation'=>'required',
            'image'=>$this->route('id') ? 'nullable|image' :'nullable|image',
        ];
    }

    public function messages(){
        return [
            'name.required'=>'Please Enter the Name',
            'name.min'=>'Name must be at least 3 character long',
            'address.required'=>'Please Enter the Address',
            'designation.required'=>'Please Enter the Designation',
            // 'image.required'=>'Please Insert the image',
            'image.image'=>'Image must be a type of jpg,png,jpeg'
        ];
    }
}

