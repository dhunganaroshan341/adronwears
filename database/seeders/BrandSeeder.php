<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = Brand::factory()->count(10)->make(); // generate but don't insert yet

        foreach ($clients as $client) {
            Brand::updateOrCreate(
                ['email' => $client->email], // condition
                $client->toArray()           // data to insert/update
            );
        }
    }
}
