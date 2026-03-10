<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;



use App\Models\Team;

class TeamSeeder extends Seeder
{
    public function run(): void
    {
        Team::factory()->count(50)->create();
    }
}
