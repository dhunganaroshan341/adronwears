<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FrontendRequest extends FormRequest
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
            'about_us_title'=>'required',
            'about_us_description'=>'required',
            'about_us_value'=>'required',
            'about_us_value_description'=>'required',
            'contact_us_email'=>'required|email',
            'contact_us_address'=>'required',
            'contact_us_number'=>'required|numeric|min:7'
        ];
    }

    public function messages(){
        return [
            'about_us_title.required'=>'Please Enter the title',
            'about_us_description.required'=>'Please Enter the description',
            'about_us_value.required'=>'Please Enter the Value title',
            'about_us_value_description.required'=>'Please Enter the Value description',
            'contact_us_email.required'=>'Please Enter the Email address',
            'contact_us_email.email'=>'Please Enter valid Email address',
            'contact_us_number.required'=>'Please Enter your contact number',
            'contact_us_number.numeric'=>'Contact Number must be of numberic letter',
            'contact_us_number.min'=>'Contact Number must be of 7 digits number'
        ];
    }
}
