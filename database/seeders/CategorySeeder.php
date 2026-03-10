<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Adventure Travel',
            'Cultural Tours',
            'Nature & Wildlife',
            'Family Vacations',
            'Hiking & Trekking',
            'Historical Destinations',
            'Luxury Escapes',
            'Budget Travel',
            'Travel Tips',
            'Destination Guides',
            'Travel News',
            'Festival & Events',
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => Str::slug($category)],
                [
                    'title' => $category,
                    'slug' => Str::slug($category),
                    'status' => 'Active', // or 1, depending on your schema
                ]
            );
        }
    }
}
