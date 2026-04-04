<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductVariation;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = ProductCategory::all();

        // 🔥 20 base product names
        $baseProducts = [
            'Classic T-Shirt',
            'Slim Fit Jeans',
            'Casual Hoodie',
            'Formal Shirt',
            'Running Sneakers',
            'Leather Jacket',
            'Sports Shorts',
            'Denim Jacket',
            'Cotton Polo',
            'Winter Coat',
            'Basic Joggers',
            'Oversized Tee',
            'Track Pants',
            'Blazer',
            'Gym Tank',
            'Cargo Pants',
            'Wool Sweater',
            'Flip Flops',
            'Baseball Cap',
            'Travel Backpack',
        ];

        $targetGroups = ['male', 'female', 'unisex', 'kids', 'kids_boys', 'kids_girls'];

        $sizes = ['S', 'M', 'L'];
        $colors = ['Red', 'Black', 'Blue'];

        // 🔁 generate ~400 products
        for ($i = 1; $i <= 400; $i++) {

            $name = $baseProducts[array_rand($baseProducts)] . " {$i}";

            $product = Product::create([
                'product_category_id' => $categories->random()->id,
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => 'Sample product for testing',
                'target_group' => $targetGroups[array_rand($targetGroups)],
                'type' => rand(0, 10) > 8 ? 'bundle' : 'simple', // ~20% bundles
                'price' => rand(500, 5000),
                'sale_price' => rand(0, 1) ? rand(300, 4000) : null,
                'is_featured' => rand(0, 1),
                'is_new' => rand(0, 1),
                'is_on_sale' => rand(0, 1),
                'total_stock' => rand(10, 100),
                'brand' => 'TestBrand',
                'thumbnail' => null,
                'status' => 'active',
            ]);

            // 🎁 If bundle → attach random items
            if ($product->type === 'bundle') {
                $product->update([
                    'bundle_items' => collect(range(1, 3))->map(function () use ($categories) {
                        return ['product_id' => rand(1, 50)];
                    }),
                ]);
            }

            // 🔥 Create 3 variations
            foreach (range(1, 3) as $v) {

                $size = $sizes[array_rand($sizes)];
                $color = $colors[array_rand($colors)];

                ProductVariation::create([
                    'product_id' => $product->id,
                    'attributes' => json_encode([
                        'size' => $size,
                        'color' => $color,
                    ]),
                    'size' => $size,
                    'color' => $color,
                    'sku' => strtoupper(Str::random(10)),
                    'stock' => rand(1, 50),
                    'price' => rand(500, 5000),
                    'sale_price' => rand(0, 1) ? rand(300, 4000) : null,
                    'image' => null,
                    'status' => 'active',
                ]);
            }
        }
    }
}
