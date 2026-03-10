<?php

namespace Database\Seeders;

use App\Models\PageBanner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageBannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $pageBanners = [
            'all','home','gallery','blog','contact','about','services'

        ];
        foreach($pageBanners as $banner){
            PageBanner::updateOrCreate(['page'=>$banner,'section'=>'banner','image'=>null]);
        }
    }
}
