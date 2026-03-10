<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'email' => 'required|email|max:255', // remove :dns

            'phone' => [
                'nullable',
                'string',
                'max:20',
                'regex:/^\+\d{1,4}[0-9\s\-]{6,14}$/'
            ],
            'message' => [
                'required',
                'string',
                'max:1000',
                'not_regex:/\b(congrat|winner|prize|lottery|free\ money|click\ here)\b/i'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'    => 'Please enter your name',
            'name.regex'       => 'Name can only contain letters and spaces',
            'email.required'   => 'Please enter your email',
            'email.email'      => 'Please enter a valid email address',
            'email.dns'        => 'Please enter a valid email domain',
            'phone.regex'      => 'Phone number must include country code and be valid',
            'message.required' => 'Please enter a message',
            'message.max'      => 'Maximum message length is 1000 characters',
            'message.not_regex'=> 'Your message contains spammy words',
        ];
    }
}
