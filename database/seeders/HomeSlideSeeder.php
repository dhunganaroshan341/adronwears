<?php

namespace Database\Seeders;

use App\Models\HomeSlide;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HomeSlideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       // Create 5 new slides
        HomeSlide::factory()->count(5)->create();
    }
}
