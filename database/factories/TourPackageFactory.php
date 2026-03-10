<?php
namespace Database\Factories;
use App\Models\TourPackage;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class TourPackageFactory extends Factory
{
    protected $model = TourPackage::class;

    public function definition(): array
    {
        $title = $this->faker->sentence(3);

        return [
            // 🟢 Pick from existing IDs
            'our_country_id' => $this->faker->numberBetween(1, 4),
            'service_id' => $this->faker->optional()->numberBetween(1, 2),
            'type' => $this->faker->randomElement(['trekking', 'tour', ]),

            'title' => $title,
            'slug' => Str::slug($title) . '-' . $this->faker->unique()->numberBetween(1000, 9999),
            'short_description' => $this->faker->paragraph,
            'long_description' => $this->faker->paragraphs(3, true),
            'what_to_expect' => $this->faker->paragraphs(2, true),
            'itinerary' => $this->faker->paragraphs(4, true),
            'duration' => $this->faker->numberBetween(3, 20) . ' Days',
            'difficulty' => $this->faker->randomElement(['easy', 'moderate', 'hard']),
            'max_elevation' => $this->faker->numberBetween(1000, 5000),
            'best_season' => $this->faker->monthName . ' - ' . $this->faker->monthName,
            'pickup' => 'Tribhuvan International Airport (KTM)',
            'drop' => 'Tribhuvan International Airport (KTM)',
            'start_point' => $this->faker->city,
            'end_point' => $this->faker->city,
            'price_includes' => json_encode(['Meals', 'Accommodation', 'Transport']),
            'price_excludes' => json_encode(['Visa fees', 'Travel insurance']),
            'images' => json_encode(['tour1.jpg', 'tour2.jpg']),
            'status' => $this->faker->randomElement(['Active', 'Inactive']),
        ];
    }
}
