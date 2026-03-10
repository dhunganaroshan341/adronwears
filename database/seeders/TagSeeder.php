<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;



class TagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = [
            'Adventure',
            'Backpacking',
            'Himalayas',
            'Trekking Tips',
            'Cultural Tours',
            'Nature Trails',
            'Budget Travel',
            'Mountain Climbing',
            'Wildlife',
            'Photography',
            'Camping',
            'Eco Travel',
            'Local Cuisine',
            'Hidden Gems',
            'Travel Guide',
            'High Altitude',
            'Tea House Trek',
            'Travel Safety',
            'Base Camp',
            'Best Seasons'
        ];

        foreach ($tags as $tag) {
            Tag::firstOrCreate(['name' => $tag]);
        }
    }
}
