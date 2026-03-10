<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkingRequest extends FormRequest
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
            'starting_time'=>'required|date_format:H:i',
            'ending_time'=>'required|date_format:H:i',
            'days'=>'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday|array',
        ];
    }

    public function messages()
    {
        return [
            'starting_time.required'=>'Please Enter Starting Time',
            'starting_time.date_format'=>'Invalid time Format',
            'ending_time.required'=>'Please Enter Ending Time',
            'ending_time.date_format'=>'Invalid time format',
            'days.required'=>'Please Select the days',
            'days.in'=>'Please Select from dropdown options only',
            'days.array'=>'Days must be a type of Array'
        ];
    }
}
