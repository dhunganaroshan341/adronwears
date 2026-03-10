<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HomeSlide>
 */
class HomeSlideFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
   public function definition(): array
{
    return [
        'image' => 'test.jpg',
        'title' => fake()->word(),
        'shortdesc' => fake()->paragraph(),
        'link_text' => fake()->word(),
        'link_url' => fake()->word(),
    ];
}

}
