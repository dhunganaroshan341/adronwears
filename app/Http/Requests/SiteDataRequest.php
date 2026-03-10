<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SiteDataRequest extends FormRequest
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
        $days=['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
        return [
            'site_title'=>'required|min:3',
            'site_logo'=>'required|mimes:png,jpg,webp',
            // 'starting_days.*'=>['required',implode($days)],
            // 'ending_days.*'=>['required',implode($days)],
            // 'starting_times.*'=>'required|timezone',
            // 'ending_times.*'=>'required|timezone'
        ];
    }


    public function messages(){
        return [
            'site_title.required'=>'Please Enter the Site Title',
            'site_title.min'=>'Title Should be at least 3 character long',
            'site_logo.required'=>'Please Choose the Site Logo',
            'site_logo.mimes'=>'Image Must be of JPG,PNG,WEBP',
            'starting_days.*.required'=>'Please Select the Starting Day',
            'ending_days.*.required'=>'Please Select the Ending Day',
            'starting_times.*.required'=>'Please Enter the Starting Time',
            'ending_times.*.required'=>'Please Enter the Ending Time'
        ];
    }
}
