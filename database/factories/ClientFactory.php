<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // 'name','email','address','contact','image','description'
        return [
            //
            'name'=>fake()->name(),
            'email'=>fake()->unique()->safeEmail(),
            'address'=>fake()->address(),
            'contact'=>fake()->phoneNumber(),
            'image'=>fake()->imageUrl(),
            'description'=>fake()->paragraph(),
            'created_at'=>now(),
            'updated_at'=>now(),

        ];
    }
}
