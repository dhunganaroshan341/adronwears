<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Testimonial>
 */
class TestimonialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>fake()->name(),
            // 'image'=>fake()->image(),
            // 'image' => fake()->image('public/images/testimonial/', 360, 360, 'animals', true, 'cats', true, 'jpg'),
            'address'=>fake()->address(),
            'designation'=>fake()->jobTitle(),
            'description'=>fake()->paragraph()
        ];
    }
}
