<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
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
            'full_name'=>'required|min:3',
            'email'=>['required','email',$this->route('id') ?  Rule::unique('users')->ignore($this->route('id')) : 'unique:users,email'],
            'position'=>'required',
            'phonenumber'=>'required|min:7|max:11',
            'password'=>$this->route('id') ? 'nullable': ['required',Password::min(8)->mixedCase()->numbers()->symbols()],
            'image'=>'image|mimes:png,jpg,jpeg,webp',

        ];
    }

    public function messages(){
        return [
            'full_name.required'=>'Please Enter your Full Name',
            'full_name.min'=>'Name must be at least 3 character',
            'email.required'=>'Please Enter you Email Address',
            'email.email'=>'Invalid Email ID',
            'position.required'=>'Please Enter your Position',
            'password.required'=>'Please Enter your Password',
            'password.min'=>'Please Enter at least 8 character long',
            'password.mixedCase'=>'Please Enter at least One Upper and One Lower character',
            'password.numbers'=>'Please Enter at least One number',
            'password.symbols'=>'Please Enter at least One Symbol',
            'phonenumber.required'=>'Please Enter your Phone number',
            'phonenumber.min'=>'Phone Number must be at least of 7 digits',
            'phonenumber.max'=>'Phone Number must be of 11 digits only',
            'image.image'=>'Image must be a type of JPG,PNG,JPEG',
            'image.mimes'=>'Image must be a type of JPG,PNG,JPEG',
        ];
    }
}
