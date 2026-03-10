<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;
use App\Models\OurCountry;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        $countries = [
            [
                'name' => 'Tibet',
                'slug' => 'tibet',
                'description' => 'Tibet, the roof of the world, famous for its stunning Himalayan landscapes.',
            ],
            [
                'name' => 'India',
                'slug' => 'india',
                'description' => 'India, a diverse and vibrant country with rich history and culture.',
            ],
            [
                'name' => 'Bhutan',
                'slug' => 'bhutan',
                'description' => 'Bhutan, the land of happiness, known for its monasteries and beautiful nature.',
            ],
            [
                'name' => 'Nepal',
                'slug' => 'nepal',
                'description' => 'Nepal, home of the highest mountains and rich cultural heritage.',
            ],
        ];

        foreach ($countries as $country) {
            OurCountry::updateOrCreate(['slug' => $country['slug']], $country);
        }
    }
}
