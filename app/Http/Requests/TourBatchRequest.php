<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TourBatchRequest extends FormRequest
{
    public function authorize(): bool
    {
        // You can add logic here if needed, for now we'll allow all
        return true;
    }

    public function rules(): array
    {
        return [
            'tour_package_id' => 'required|exists:tour_packages,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'max_people' => 'required|integer|min:1',
            'available_seats' => 'required|integer|min:0|lte:max_people',
            'price' => 'nullable|integer|min:0',
            'status' => 'required|in:active,full,closed',
        ];
    }

    public function messages(): array
    {
        return [
            'tour_package_id.required' => 'Tour package is required.',
            'tour_package_id.exists' => 'Selected tour package does not exist.',
            'start_date.required' => 'Start date is required.',
            'start_date.after_or_equal' => 'Start date cannot be in the past.',
            'end_date.after_or_equal' => 'End date must be the same or after the start date.',
            'max_people.required' => 'Maximum people is required.',
            'available_seats.lte' => 'Available seats cannot exceed max people.',
            'status.in' => 'Status must be active, full, or closed.',
        ];
    }
}
