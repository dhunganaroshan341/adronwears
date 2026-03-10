<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TeamFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name'     => $this->faker->name(),
            'position' => $this->faker->jobTitle(),
            // 'photo'    => 'https://i.pravatar.cc/300?img=' . $this->faker->numberBetween(1, 70),
            'facebook' => $this->faker->url(),
            'twitter'  => $this->faker->url(),
            'linkedin' => $this->faker->url(),
        ];
    }
}
