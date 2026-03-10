<?php
// database/factories/UserFactory.php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'full_name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('password123'), // Can use Hash::make too
            'image' => 'front/images/team/team6.jpg', // ✅ Use relative path from public folder
            'role' => $this->faker->randomElement(['Admin', 'User']),
            'position' => $this->faker->jobTitle(),
            'email_link' => $this->faker->email(),
            'facebook_link' => $this->faker->url(),
            'instagram_link' => 'https://instagram.com/' . $this->faker->userName(),
            'twitter_link' => 'https://twitter.com/' . $this->faker->userName(),
            'phonenumber' => $this->faker->phoneNumber(),
            'notes' => $this->faker->paragraph(),
            'google_id' => $this->faker->uuid(),
        ];
    }
}
