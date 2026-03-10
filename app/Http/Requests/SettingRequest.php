<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'title' => 'required|min:3',
            'logo' => 'nullable|mimes:png,jpg,webp,jpeg',
            'description' => 'nullable|string',
            'work_description' => 'nullable|string',
            'office_hours' => 'nullable|string',

            // Primary Office
            'contact' => 'nullable|numeric|min:7',
            'phone1' => 'nullable|numeric|min:7',
            'phone2' => 'nullable|numeric|min:7',
            'landline1' => 'nullable|numeric|min:7',
            'email' => 'nullable|email',
            'address' => 'nullable|string',

            // Secondary Office
            'contact2' => 'nullable|numeric|min:7',
            'phone3' => 'nullable|numeric|min:7',
            'phone4' => 'nullable|numeric|min:7',
            'landline2' => 'nullable|numeric|min:7',
            'address2' => 'nullable|string',
            'email2' => 'nullable|email',


            'facebook_url' => 'nullable|url',
            'github_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',

            'starting_time' => 'nullable|date_format:H:i',
            'ending_time' => 'nullable|date_format:H:i',
            'days' => 'nullable|array',
            'days.*' => 'in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Please Enter the Title',
            'title.min' => 'Title must be at least of 3 characters',
            'logo.mimes' => 'Logo must be of type PNG, JPG, WEBP, or JPEG',
            'contact.numeric' => 'Contact number must be a number',
            'contact.min' => 'Contact number must be at least 7 digits',
            'contact2.numeric' => 'Secondary contact must be a number',
            'contact2.min' => 'Secondary contact must be at least 7 digits',
            'email.email' => 'Invalid Email Format',
            'phone1.numeric' => 'Phone number must be numeric',
            'phone2.numeric' => 'Phone number must be numeric',
            'phone3.numeric' => 'Phone number must be numeric',
            'phone4.numeric' => 'Phone number must be numeric',
            'landline1.numeric' => 'Landline must be numeric',
            'landline2.numeric' => 'Landline must be numeric',
            'days.*.in' => 'Invalid day selected'
        ];
    }
}
