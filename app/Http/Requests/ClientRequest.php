<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
        'name' => 'required|min:3',
        'email' => [
            'nullable',
            'email',
            $this->route('id')
                ? Rule::unique('clients')->ignore($this->route('id'))
                : 'unique:clients,email'
        ],
        'address' => 'nullable',
        'contact' => 'nullable|min:7',
        'image' => 'image|mimes:png,jpg,jpeg,webp',
        'type' => 'required|in:associate,affiliated', // <-- added enum validation
    ];
}


    public function messages(){
        return [

            'name.min'=>'Name must be at least 3 character',
            'email.email'=>'Invalid Email ID',
            'contact.min'=>'contact number must be at least of 7 digits',
            'image.image'=>'Image must be a type of JPG,PNG,JPEG',
            'image.mimes'=>'Image must be a type of JPG,PNG,JPEG',
        ];
    }
}
