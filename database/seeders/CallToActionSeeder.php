<?php

namespace Database\Seeders;

use App\Models\CallToAction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CallToActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected $pages = ['home','about','contact','gallery','services','blog'];
    public function run(): void
    {
        //
        foreach( $this->pages as $page){
            CallToAction::updateOrCreate(['page'=>$page,
            'title'=>'Do you need help?',
            'description'=>'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi ipsum, odit velit exercitationem praesentium error id iusto dolorem expedita nostrum eius atque? Aliquam ab reprehenderit animi sapiente quasi, voluptate dolorum?',
            'image'=>'hero_cta.jpg',
            'link'=>'contact-us'
            ]
        );
        }

    }
}
