<?php

namespace Database\Factories;

use App\Models\ServiceQuery;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceQueryFactory extends Factory
{
    protected $model = ServiceQuery::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'message' => $this->faker->sentence(),
            'service_id' => 1, // Adjust if you want random or existing service ids
        ];
    }
}
