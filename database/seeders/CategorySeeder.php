<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'cat' => 'Car Speakers',
                'slung' => Str::slug('Car Speakers'),
                'keywords' => 'car speakers, vehicle speakers, car audio speakers',
                'description' => 'High-quality car speakers for your vehicle audio system',
            ],
            [
                'cat' => 'Car Amplifiers',
                'slung' => Str::slug('Car Amplifiers'),
                'keywords' => 'car amplifiers, car amps, vehicle amplifiers',
                'description' => 'Powerful amplifiers to boost your car audio system',
            ],
            [
                'cat' => 'Car Subwoofers',
                'slung' => Str::slug('Car Subwoofers'),
                'keywords' => 'car subwoofers, car bass, vehicle subwoofers',
                'description' => 'Deep bass subwoofers for your car audio system',
            ],
            [
                'cat' => 'Car Stereos',
                'slung' => Str::slug('Car Stereos'),
                'keywords' => 'car stereos, car radios, vehicle stereos',
                'description' => 'Modern car stereo systems with Bluetooth and navigation',
            ],
            [
                'cat' => 'Car Accessories',
                'slung' => Str::slug('Car Accessories'),
                'keywords' => 'car accessories, vehicle accessories, car audio accessories',
                'description' => 'Essential accessories for your car audio system',
            ],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['cat' => $category['cat']],
                $category
            );
        }
    }
}
