<?php

namespace Database\Seeders;

use App\Models\TourPackage;
use App\Models\OurCountry;  // Assuming your country model is OurCountry
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class NewPackageSeeder extends Seeder
{
    public function run(): void
    {
        // Find the country ID where name is 'Nepal'
        $country = OurCountry::where('name', 'Nepal')->first();

        if (!$country) {
            $this->command->error("Country 'Nepal' not found! Seeder aborted.");
            return;
        }

        $parentPackages = [
            ['name' => 'Trekking Routes in Nepal', 'slug' => 'trekking-routes-in-nepal'],
            ['name' => 'Everest Region Trek', 'slug' => 'everest-region-trek'],
            ['name' => 'Mustang Region', 'slug' => 'mustang-region'],
            ['name' => 'Peak Climbing', 'slug' => 'peak-climbing'],
            ['name' => 'Family Friendly Holidays', 'slug' => 'family-friendly-holidays'],
            ['name' => 'Far Western Region Treks', 'slug' => 'far-western-region-treks'],
            ['name' => 'Annapurna Region Trek', 'slug' => 'annapurna-region-trek'],
            ['name' => 'Langtang Region Trek', 'slug' => 'langtang-region-trek'],
            ['name' => 'Off The Beaten Trails', 'slug' => 'off-the-beaten-trails'],
            ['name' => 'Manaslu Region', 'slug' => 'manaslu-region'],
        ];

        foreach ($parentPackages as $package) {
            TourPackage::updateOrCreate(
                ['slug' => $package['slug']],  // Lookup by slug
                [
                    'title' => $package['name'],
                    'our_country_id' => $country->id,
                    // Add other default fields if needed here
                ]
            );
        }

        $this->command->info('Parent tour packages seeded successfully.');
    }
}
