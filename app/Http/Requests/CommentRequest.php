<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'content' => 'required|string|max:1000',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'commentable_id' => 'required|integer',
            'commentable_type' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'content.required' => 'Please Enter the Comment',
            'content.max' => 'Max lenght of comment is 1000',
            'name.required' => 'Please Enter Your Name',
            'name.max' => 'Max length of name is 255',
            'email.required' => 'Please Enter Your Email',
            'email.email' => 'Please Enter a valid Email Address',
            'email.max' => 'Max length of email is 255'
        ];
    }
}
