<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $blogs = [
            [
                'title' => 'How to Choose the Right Car Speakers',
                'slung' => Str::slug('How to Choose the Right Car Speakers'),
                'content' => 'Choosing the right car speakers can make a huge difference in your audio experience. This guide will help you understand what to look for.',
                'author' => 'Admin',
                'category' => 'Guides',
                'link' => '/blog/how-to-choose-right-car-speakers',
            ],
            [
                'title' => 'Top 5 Car Audio Brands in 2024',
                'slung' => Str::slug('Top 5 Car Audio Brands in 2024'),
                'content' => 'Discover the top car audio brands that are leading the market in 2024. From Sony to Pioneer, find out which brand suits your needs.',
                'author' => 'Admin',
                'category' => 'Reviews',
                'link' => '/blog/top-5-car-audio-brands-2024',
            ],
            [
                'title' => 'Car Audio Installation Tips',
                'slung' => Str::slug('Car Audio Installation Tips'),
                'content' => 'Learn professional tips for installing car audio systems. Avoid common mistakes and get the best sound quality.',
                'author' => 'Admin',
                'category' => 'Tips',
                'link' => '/blog/car-audio-installation-tips',
            ],
            [
                'title' => 'Understanding Car Amplifier Power',
                'slung' => Str::slug('Understanding Car Amplifier Power'),
                'content' => 'Understanding amplifier power ratings is crucial for getting the best performance from your car audio system.',
                'author' => 'Admin',
                'category' => 'Education',
                'link' => '/blog/understanding-car-amplifier-power',
            ],
            [
                'title' => 'Best Subwoofers for Your Car',
                'slung' => Str::slug('Best Subwoofers for Your Car'),
                'content' => 'Find the perfect subwoofer for your car. We review the best options available in the market.',
                'author' => 'Admin',
                'category' => 'Reviews',
                'link' => '/blog/best-subwoofers-for-your-car',
            ],
        ];

        foreach ($blogs as $blog) {
            DB::table('blogs')->updateOrInsert(
                ['slung' => $blog['slung']],
                $blog
            );
        }
    }
}
