<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            ['name' => 'Nike'],
            ['name' => 'Adidas'],
            ['name' => 'Puma'],
            ['name' => 'Reebok'],
            ['name' => 'Under Armour'],
            ['name' => 'New Balance'],
            ['name' => 'Converse'],
            ['name' => 'Vans'],
            ['name' => 'Levi\'s'],
            ['name' => 'Wrangler'],
            ['name' => 'Lee'],
            ['name' => 'Tommy Hilfiger'],
            ['name' => 'Calvin Klein'],
            ['name' => 'Lacoste'],
            ['name' => 'Hugo Boss'],
            ['name' => 'Ralph Lauren'],
            ['name' => 'Diesel'],
            ['name' => 'Gap'],
            ['name' => 'Uniqlo'],
            ['name' => 'Zara'],
            ['name' => 'H&M'],
            ['name' => 'Mango'],
            ['name' => 'Superdry'],
            ['name' => 'Jack & Jones'],
            ['name' => 'The North Face'],
            ['name' => 'Columbia'],
            ['name' => 'Patagonia'],
            ['name' => 'Champion'],
            ['name' => 'Fila'],
            ['name' => 'Asics'],
        ];

        foreach ($brands as $brand) {
            Brand::updateOrCreate(
                ['name' => $brand['name']],
                $brand
            );
        }
    }
}
