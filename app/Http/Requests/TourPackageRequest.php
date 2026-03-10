<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TourPackageRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $tourPackageId = $this->route('id');

        return [
            'our_country_id' => 'required|exists:our_countries,id',
            'service_id' => 'nullable|exists:countries,id',
            'parent_id' => 'nullable|exists:tour_packages,id',
            'title' => 'required|string|max:255',
            'slug' => [
                'nullable',
                'string',
                'max:255',
                $tourPackageId
                    ? Rule::unique('tour_packages', 'slug')->ignore($tourPackageId)
                    : Rule::unique('tour_packages', 'slug'),
            ],
            'short_description' => 'nullable|string',
            'long_description' => 'nullable|string',
            'what_to_expect' => 'nullable|string',
            'itinerary' => 'nullable|string',
            'location' => 'nullable|string',
            'price' => 'nullable|string',
            'price_includes' => 'nullable|string',
            'price_excludes' => 'nullable|string',
            'duration' => 'nullable|string|max:100',
            'accomodation' => 'nullable|string|max:100',
            'difficulty' => 'nullable|in:easy,moderate,hard',
            'max_elevation' => 'nullable|integer|min:0',
            'best_season' => 'nullable|string|max:100',
            'start_point' => 'nullable|string|max:255',
            'end_point' => 'nullable|string|max:255',
            'status' => 'nullable|in:Active,Inactive',
            'package_type' => 'nullable|in:trekking,tour,other',
            'max_people' => 'nullable|integer|min:1',
            'available_seats' => 'nullable|integer|min:0|lte:max_people',

            // ✅ Newly added boolean fields
            'top_deal' => 'nullable|boolean',
            'favourite_destination' => 'nullable|boolean',
        ];
    }
}
