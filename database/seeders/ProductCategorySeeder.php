<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\ProductCategory;

class ProductCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Clothing' => [
                'Tops' => [
                    'T-Shirts',
                    'Shirts',
                    'Polos',
                    'Hoodies',
                    'Sweaters',
                ],
                'Bottoms' => [
                    'Jeans',
                    'Trousers',
                    'Shorts',
                    'Joggers',
                ],
                'Outerwear' => [
                    'Jackets',
                    'Coats',
                    'Blazers',
                ],
                'Activewear' => [
                    'Gym Wear',
                    'Sportswear',
                    'Compression Wear',
                ],
                'Innerwear' => [
                    'Underwear',
                    'Socks',
                    'Thermals',
                ],
            ],

            'Footwear' => [
                'Casual Shoes',
                'Sneakers',
                'Formal Shoes',
                'Boots',
                'Sandals',
                'Slippers',
            ],

            'Accessories' => [
                'Belts',
                'Wallets',
                'Sunglasses',
                'Watches',
                'Hats & Caps',
                'Scarves',
            ],

            'Bags' => [
                'Backpacks',
                'Laptop Bags',
                'Travel Bags',
                'Handbags',
                'Suitcases',
            ],

            'Sports & Outdoors' => [
                'Fitness Equipment',
                'Yoga Accessories',
                'Outdoor Gear',
                'Water Bottles',
            ],

            'Seasonal Collections' => [
                'Summer Collection',
                'Winter Collection',
                'Sale Items',
                'New Arrivals',
            ],

            'Lifestyle' => [
                'Gift Items',
                'Travel Essentials',
                'Daily Use Products',
            ],
        ];

        $this->createCategories($categories);
    }

    private function createCategories(array $categories, $parentId = null): void
    {
        foreach ($categories as $key => $value) {

            // leaf node
            if (is_int($key)) {
                $name = $value;
                $children = [];
            } else {
                $name = $key;
                $children = $value;
            }

            $category = ProductCategory::firstOrCreate(
                [
                    'slug' => Str::slug($name),
                    'parent_id' => $parentId,
                ],
                [
                    'name' => $name,
                    'status' => 'active',
                ]
            );

            if (!empty($children)) {
                $this->createCategories($children, $category->id);
            }
        }
    }
}
