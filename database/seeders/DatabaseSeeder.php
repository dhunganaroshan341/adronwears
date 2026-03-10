<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            // frontendseeder::class,
            UserSeeder::class,
            SettingSeeder::class,
            ClientSeeder::class,
            PageBannerSeeder::class,
            // GallerySeeder::class,
            CallToActionSeeder::class,
            CategorySeeder::class,
            PostSeeder::class,
            PostImageSeeder::class,
            ServiceSeeder::class,
            HomeSlideSeeder::class,
            TestimonialSeeder::class,
            ServiceQuerySeeder::class,
            CountrySeeder::class,
            // TourPackageSeeder::class,
            AchievementSeeder::class,
            PageSeeder::class,
            TagSeeder::class,
        ]);
    }
}
