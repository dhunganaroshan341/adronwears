<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePackageBookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id'         => 'nullable|exists:users,id',
            'email'           => 'required|email|max:255',

            'name'            => 'nullable|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'message'         => [
                'nullable',
                'string',
                'max:1000',
                'not_regex:/\b(congrat|winner|prize|lottery|free\ money|click\ here)\b/i'
            ],
            'phone' => [
                'nullable',
                'string',
                'max:20',
                'regex:/^\+\d{1,4}[0-9\s\-]{6,14}$/'
            ],
            'country'         => 'nullable|string|max:100',
            'children'        => 'nullable|integer|min:0',
            'adult'           => 'nullable|integer|min:0',
            'total_people'    => 'nullable|integer|min:1',
            'price'           => 'nullable|numeric|min:0',
            'tour_package_id' => 'nullable|exists:tour_packages,id',
            'tour_batch_id'   => 'nullable|exists:tour_batches,id',
            'custom_date'     => 'nullable|date|after_or_equal:today',
            'booking_type'    => 'required|in:batch,custom',
            'status'          => 'in:pending,confirmed,cancelled,active,inactive',
        ];
    }

    public function messages(): array
    {
        return [
            'name.regex'       => 'Name can only contain letters and spaces',
            'phone.regex'      => 'Phone number must include country code and be valid',
            'message.not_regex'=> 'Your message contains spammy words',
            'custom_date.after_or_equal' => 'Custom date must be today or a future date',
        ];
    }
}
























// old recaptcha
// namespace App\Http\Requests;

// use Illuminate\Foundation\Http\FormRequest;
// use Illuminate\Support\Facades\Http;
// class StorePackageBookingRequest extends FormRequest
// {
//     public function authorize(): bool
//     {
//         return true;
//     }

//     protected function passedValidation()
// {
//     $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
//         'secret' => env('RECAPTCHA_SECRET_KEY'),
//         'response' => $this->input('g-recaptcha-response'),
//         'remoteip' => $this->ip(),
//     ]);

//     $score = $response->json();
//     if (!($score['success'] ?? false)) {
//         abort(422, 'reCAPTCHA verification failed. Please try again.');
//     }
// }

//     public function rules(): array
//     {
//         return [
//             'user_id'         => 'nullable|exists:users,id',
//         'email' => 'required|email|max:255', // remove :dns

//             'name'            => 'nullable|string|max:255|regex:/^[a-zA-Z\s]+$/',
//             'message'         => [
//                 'nullable',
//                 'string',
//                 'max:1000',
//                 'not_regex:/\b(congrat|winner|prize|lottery|free\ money|click\ here)\b/i'
//             ],
//             'phone' => [
//                 'nullable',
//                 'string',
//                 'max:20',
//                 'regex:/^\+\d{1,4}[0-9\s\-]{6,14}$/'
//             ],
//             'country'         => 'nullable|string|max:100',
//             'children'        => 'nullable|integer|min:0',
//             'adult'           => 'nullable|integer|min:0',
//             'total_people'    => 'nullable|integer|min:1',
//             'price'           => 'nullable|numeric|min:0',
//             'tour_package_id' => 'nullable|exists:tour_packages,id',
//             'tour_batch_id'   => 'nullable|exists:tour_batches,id',
//             'custom_date'     => 'nullable|date|after_or_equal:today',
//             'booking_type'    => 'required|in:batch,custom',
//             'status'          => 'in:pending,confirmed,cancelled,active,inactive',
//         ];
//     }

//     public function messages(): array
//     {
//         return [
//             'name.regex'       => 'Name can only contain letters and spaces',
//             'email.dns'        => 'Please enter a valid email domain',
//             'phone.regex'      => 'Phone number must include country code and be valid',
//             'message.not_regex'=> 'Your message contains spammy words',
//             'custom_date.after_or_equal' => 'Custom date must be today or a future date',
//         ];
//     }
// }
