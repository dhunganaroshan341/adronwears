<?php

namespace Database\Seeders;

use App\Models\TourPackage;
use App\Models\TourPackageType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TourPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $tourPackageTypes = [
        [
            'name' => 'travel',
            'description' => 'Explore beautiful places with our travel packages.',
        ],
        [
            'name' => 'trekking',
            'description' => 'Adventure trekking experiences in the Himalayas.',
        ],
    ];

    foreach ($tourPackageTypes as $type) {
    TourPackageType::updateOrCreate(
        ['name' => $type['name']], // Lookup condition (typically unique)
        [
            'slug' => Str::slug($type['name']),
            'description' => $type['description'],
        ]
    );
}

        TourPackage::factory()->count(10)->create();
    }
}
