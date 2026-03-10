<?php

namespace Database\Factories;

use App\Models\PostImage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PostImage>
 */
class PostImageFactory extends Factory
{
    protected $model = PostImage::class;

    public function definition(): array
    {
        return [
            'image' => $this->faker->imageUrl(), // or store to storage/app/public if needed
        ];
    }
}
