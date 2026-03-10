<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServiceQuery;

class ServiceQuerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ServiceQuery::factory()->count(50)->create();
    }
}
