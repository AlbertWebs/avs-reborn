<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            [
                'title' => 'Premium Quality',
                'slung' => Str::slug('Premium Quality'),
                'keywords' => 'premium, quality, high-end',
                'content' => 'Products marked with premium quality tag',
            ],
            [
                'title' => 'Best Seller',
                'slung' => Str::slug('Best Seller'),
                'keywords' => 'bestseller, popular, trending',
                'content' => 'Our best-selling products',
            ],
            [
                'title' => 'New Arrival',
                'slung' => Str::slug('New Arrival'),
                'keywords' => 'new, latest, arrival',
                'content' => 'Latest products in our store',
            ],
            [
                'title' => 'On Sale',
                'slung' => Str::slug('On Sale'),
                'keywords' => 'sale, discount, offer',
                'content' => 'Products currently on sale',
            ],
            [
                'title' => 'Professional Grade',
                'slung' => Str::slug('Professional Grade'),
                'keywords' => 'professional, grade, commercial',
                'content' => 'Professional grade audio equipment',
            ],
        ];

        foreach ($tags as $tag) {
            Tag::firstOrCreate(
                ['title' => $tag['title']],
                $tag
            );
        }
    }
}
