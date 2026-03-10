<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AchievementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('achievements')->insert([
            [
                'title' => 'Happy Customers',
                'count' => 100,
                'icon_class' => 'fa fa-smile',
                'description' => 'Over 100 satisfied clients from around the globe.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Amazing Tours',
                'count' => 50,
                'icon_class' => 'fa fa-map-marked-alt',
                'description' => 'We’ve organized 50+ breathtaking tours across Asia.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'In Business',
                'count' => 3472,
                'icon_class' => 'fa fa-briefcase',
                'description' => 'Over 3,400 days of consistent travel excellence.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Support Case',
                'count' => 523,
                'icon_class' => 'fa fa-headset',
                'description' => 'Issues solved for our beloved travelers with care.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
