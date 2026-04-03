<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = [
            // 🧥 Clothing & Fashion
            'New Arrival',
            'Best Seller',
            'Limited Edition',
            'Summer Collection',
            'Winter Collection',
            'Casual Wear',
            'Formal Wear',
            'Streetwear',
            'Luxury',

            // 💰 Pricing / Offers
            'Discount',
            'Sale',
            'Clearance',
            'Budget Friendly',
            'Premium',

            // 🧍 Target Style
            'Trendy',
            'Minimal',
            'Classic',
            'Sporty',
            'Vintage',

            // 🧵 Material / Quality
            'Cotton',
            'Polyester',
            'Organic',
            'Handmade',
            'Eco Friendly',

            // 👕 Product Type
            'T-Shirts',
            'Hoodies',
            'Jackets',
            'Jeans',
            'Shoes',
            'Accessories',

            // 🎯 Use Case
            'Gym Wear',
            'Outdoor',
            'Everyday Use',
            'Work Wear',
            'Travel Friendly',

            // 🌍 General Ecommerce SEO Tags
            'Unisex',
            'Men',
            'Women',
            'Kids',
            'Gift Idea',
        ];

        foreach ($tags as $tag) {
            Tag::firstOrCreate([
                'name' => $tag
            ]);
        }
    }
}
