<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ItineraryRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Allow all users to make this request
        return true;
    }

    public function rules(): array
    {
        return [
            'tour_package_id' => 'required|exists:tour_packages,id',
            'day_number'      => 'nullable|integer|min:1|max:365',
            'status'          => 'nullable|in:Active,Inactive',
            'title'           => 'nullable|string|max:255',
             'order'           => [
            'nullable',
            'integer',
            Rule::unique('itineraries')
                ->where(function ($query) {
                    return $query->where('tour_package_id', $this->tour_package_id);
                })
                ->ignore($this->id) // for update case
        ],
            'description'     => 'required|string',
        ];
    }
}
