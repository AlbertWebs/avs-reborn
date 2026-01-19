<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sliders = [
            [
                'name' => 'Premium Car Audio Systems',
                'content' => 'Transform your driving experience with our premium car audio systems. Quality sound for every journey.',
            ],
            [
                'name' => 'Latest Car Speakers',
                'content' => 'Discover our latest collection of high-quality car speakers. Crystal clear sound, powerful bass.',
            ],
            [
                'name' => 'Professional Installation',
                'content' => 'Expert installation services for all your car audio needs. Professional technicians at your service.',
            ],
            [
                'name' => 'Special Offers',
                'content' => 'Check out our special offers and discounts on premium car audio equipment. Limited time only!',
            ],
            [
                'name' => 'Best Brands Available',
                'content' => 'Shop from top brands including Sony, Pioneer, Kenwood, JBL, and Alpine. Quality guaranteed.',
            ],
        ];

        foreach ($sliders as $slider) {
            DB::table('slider')->updateOrInsert(
                ['name' => $slider['name']],
                $slider
            );
        }
    }
}
