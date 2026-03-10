<?php

namespace Database\Factories;

use App\Models\TourBatch;
use App\Models\TourPackage;
use Illuminate\Database\Eloquent\Factories\Factory;

class BatchFactory extends Factory
{
    protected $model = TourBatch::class;

    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('now', '+3 months');
        $endDate = (clone $startDate)->modify('+5 days');

        return [
            'tour_package_id' => TourPackage::factory(), // Make sure you have a TourPackageFactory or seed some first
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => $endDate->format('Y-m-d'),
            'max_people' => $max = $this->faker->numberBetween(10, 30),
            'available_seats' => $this->faker->numberBetween(0, $max),
            'price' => $this->faker->numberBetween(5000, 25000),
            'status' => $this->faker->randomElement(['active', 'full', 'closed']),
        ];
    }
}
