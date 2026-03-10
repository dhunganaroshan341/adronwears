<?php

namespace App\SampleData;

class HomeSampleData
{
    protected $destinations = [
        [
            'image' => 'template/yatri_world/main-file/images/trending/trending8.jpg',
            'title' => 'Nepal Special Tour',
            'reviews' => 38,
            'places' => 852,
            'location' => 'Nepal',
            'description' => 'A wonderful little cottage right on the seashore - perfect for exploring.',
            'reviewer' => 'Thu Astudillo',
            'reviewer_img' => 'template/yatri_world/main-file/images/reviewer/1.jpg'
        ],
        [
            'image' => 'template/yatri_world/main-file/images/trending/trending11.jpg',
            'title' => 'Canada New Year Tour',
            'reviews' => 38,
            'places' => 615,
            'location' => 'Canada',
            'description' => 'Perfect winter holiday for the festive season.',
            'reviewer' => 'Jane Doe',
            'reviewer_img' => 'template/yatri_world/main-file/images/reviewer/2.jpg'
        ],
        [
            'image' => 'template/yatri_world/main-file/images/trending/trending12.jpg',
            'title' => 'America Christmas Tour',
            'reviews' => 25,
            'places' => 430,
            'location' => 'USA',
            'description' => 'Explore vibrant cities during Christmas.',
            'reviewer' => 'John Smith',
            'reviewer_img' => 'template/yatri_world/main-file/images/reviewer/3.jpg'
        ],
        [
            'image' => 'template/yatri_world/main-file/images/trending/trending10.jpg',
            'title' => 'Bali Island Tour',
            'reviews' => 41,
            'places' => 300,
            'location' => 'Indonesia',
            'description' => 'Beach paradise with tropical vibes.',
            'reviewer' => 'Emily Watson',
            'reviewer_img' => 'template/yatri_world/main-file/images/reviewer/4.jpg'
        ],
        [
            'image' => 'template/yatri_world/main-file/images/trending/trending9.jpg',
            'title' => 'Japan Spring Tour',
            'reviews' => 19,
            'places' => 210,
            'location' => 'Japan',
            'description' => 'Cherry blossoms and traditional beauty.',
            'reviewer' => 'Ken Takahashi',
            'reviewer_img' => 'template/yatri_world/main-file/images/reviewer/5.jpg'
        ]
    ];

    public function getSampleData($variable = null)
    {
        if ($variable) {
            $reflection = new \ReflectionClass($this);

            if ($reflection->hasProperty($variable)) {
                $property = $reflection->getProperty($variable);
                $property->setAccessible(true);
                $value = $property->getValue($this);

                // Convert to object recursively
                return json_decode(json_encode($value));
            } else {
                return null; // Or throw new \Exception("Property '$variable' not found.");
            }
        }

        return null;
    }
}
