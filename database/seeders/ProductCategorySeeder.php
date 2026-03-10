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
            'Apparel / Clothing' => [
                'Men' => [
                    'Innerwear' => ['Briefs', 'Boxers', 'Undershirts'],
                    'Outerwear' => ['Jackets', 'Coats', 'Hoodies / Sweatshirts'],
                    'Tops' => ['T-Shirts', 'Shirts', 'Polos'],
                    'Bottoms' => ['Jeans', 'Trousers', 'Shorts'],
                    'Seasonal' => ['Winter', 'Summer'],
                ],
                'Women' => [
                    'Innerwear' => ['Bras', 'Panties', 'Lingerie Sets'],
                    'Outerwear' => ['Jackets', 'Coats', 'Sweaters'],
                    'Tops' => ['Blouses', 'T-Shirts', 'Tunics'],
                    'Bottoms' => ['Skirts', 'Jeans', 'Trousers'],
                    'Dresses' => ['Casual', 'Formal', 'Party'],
                    'Seasonal' => ['Winter', 'Summer'],
                ],
                'Neutral / Unisex' => [
                    'Hoodies',
                    'T-Shirts',
                    'Jackets',
                    'Activewear',
                ],
            ],

            'Footwear' => [
                'Men' => ['Casual', 'Formal', 'Sports / Sneakers', 'Sandals / Slippers'],
                'Women' => ['Heels', 'Flats', 'Sports / Sneakers', 'Sandals / Slippers'],
                'Unisex' => ['Sneakers', 'Flip-flops', 'Slides'],
            ],

            'Bags & Luggage' => [
                'Suitcases' => ['Carry-on', 'Large luggage'],
                'Backpacks' => ['School / College', 'Hiking / Outdoor', 'Laptop bags'],
                'Handbags / Purses' => ['Small', 'Medium', 'Large'],
            ],

            'Accessories' => [
                'Watches' => ['Men', 'Women', 'Smartwatches'],
                'Belts' => ['Leather', 'Casual / Fabric'],
                'Sunglasses' => ['Men', 'Women'],
                'Hats / Caps' => ['Beanies', 'Baseball caps', 'Sun hats'],
                'Scarves / Gloves' => ['Men', 'Women'],
            ],

            'Sports / Active Gear' => [
                'Men' => ['T-Shirts', 'Shorts', 'Shoes'],
                'Women' => ['Tops', 'Leggings', 'Shoes'],
                'Unisex' => ['Yoga mats', 'Water bottles', 'Sports accessories'],
            ],

            'Seasonal / Special Collections' => [
                'Winter Collection' => ['Jackets', 'Coats', 'Sweaters', 'Gloves'],
                'Summer Collection' => ['T-Shirts', 'Shorts', 'Sandals'],
                'Festive / Event Collection' => ['Partywear', 'Formalwear'],
            ],
        ];

        $this->createCategories($categories);
    }

    private function createCategories(array $categories, $parentId = null): void
    {
        foreach ($categories as $name => $children) {

            // Handle numeric keys (leaf nodes)
            if (is_int($name)) {
                $name = $children;
                $children = [];
            }

            $category = ProductCategory::firstOrCreate(
                ['slug' => Str::slug($name)],
                [
                    'name' => $name,
                    'parent_id' => $parentId,
                    'status' => 'active',
                ]
            );

            if (!empty($children)) {
                $this->createCategories($children, $category->id);
            }
        }
    }
}
