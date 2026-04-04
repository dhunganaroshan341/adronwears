<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class ProductTagSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::all();
        $allTags  = Tag::all()->keyBy('slug');

        // Map keywords in product name → relevant tag slugs
        $keywordTagMap = [
            // Product type matches
            't-shirt'   => ['t-shirts', 'casual-wear', 'cotton', 'everyday-use', 'unisex'],
            'tee'       => ['t-shirts', 'casual-wear', 'streetwear', 'everyday-use'],
            'jeans'     => ['jeans', 'casual-wear', 'classic', 'everyday-use'],
            'hoodie'    => ['hoodies', 'casual-wear', 'streetwear', 'winter-collection'],
            'shirt'     => ['formal-wear', 'work-wear', 'classic'],
            'sneakers'  => ['shoes', 'sporty', 'everyday-use', 'gym-wear'],
            'jacket'    => ['jackets', 'winter-collection', 'outdoor', 'streetwear'],
            'shorts'    => ['casual-wear', 'gym-wear', 'sporty', 'summer-collection'],
            'polo'      => ['t-shirts', 'casual-wear', 'cotton', 'classic'],
            'coat'      => ['jackets', 'winter-collection', 'luxury', 'formal-wear'],
            'joggers'   => ['casual-wear', 'gym-wear', 'sporty', 'everyday-use'],
            'track'     => ['gym-wear', 'sporty', 'outdoor'],
            'blazer'    => ['formal-wear', 'work-wear', 'luxury', 'classic'],
            'tank'      => ['gym-wear', 'sporty', 'summer-collection'],
            'cargo'     => ['casual-wear', 'outdoor', 'travel-friendly', 'streetwear'],
            'sweater'   => ['winter-collection', 'casual-wear', 'classic'],
            'flip'      => ['shoes', 'summer-collection', 'casual-wear'],
            'cap'       => ['accessories', 'streetwear', 'sporty', 'casual-wear'],
            'backpack'  => ['accessories', 'travel-friendly', 'outdoor', 'everyday-use'],
        ];

        // Map target_group → tag slugs
        $targetGroupTagMap = [
            'male'        => ['men'],
            'female'      => ['women'],
            'unisex'      => ['unisex'],
            'kids'        => ['kids'],
            'kids_boys'   => ['kids', 'men'],
            'kids_girls'  => ['kids', 'women'],
        ];

        foreach ($products as $product) {
            $tagSlugsToAttach = collect();

            // 1️⃣ Match by product name keywords
            $nameLower = strtolower($product->name);
            foreach ($keywordTagMap as $keyword => $slugs) {
                if (str_contains($nameLower, $keyword)) {
                    $tagSlugsToAttach = $tagSlugsToAttach->merge($slugs);
                }
            }

            // 2️⃣ Match by target_group
            $groupSlugs = $targetGroupTagMap[$product->target_group] ?? [];
            $tagSlugsToAttach = $tagSlugsToAttach->merge($groupSlugs);

            // 3️⃣ Add promotional tags based on product flags
            if ($product->is_new)      $tagSlugsToAttach->push('new-arrival');
            if ($product->is_featured) $tagSlugsToAttach->push('best-seller');
            if ($product->is_on_sale)  $tagSlugsToAttach->push('sale', 'discount');

            // 4️⃣ Price-based tags
            if ($product->price >= 3000) $tagSlugsToAttach->push('premium', 'luxury');
            if ($product->price <= 800)  $tagSlugsToAttach->push('budget-friendly');

            // 5️⃣ Bundle tag
            if ($product->type === 'bundle') $tagSlugsToAttach->push('gift-idea');

            // Resolve slugs → tag IDs, skip missing ones
            $tagIds = $tagSlugsToAttach
                ->unique()
                ->map(fn($slug) => $allTags->get($slug)?->id)
                ->filter()
                ->values()
                ->toArray();

            // Attach without duplicates
            $product->tags()->sync($tagIds);
        }

        $this->command->info('✅ Product tags seeded successfully!');
    }
}
