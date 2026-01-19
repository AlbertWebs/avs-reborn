<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = Category::first();
        $brand = Brand::first();

        $products = [
            [
                'name' => 'Sony XS-162ES 6.5" 2-Way Car Speakers',
                'slung' => Str::slug('Sony XS-162ES 6.5" 2-Way Car Speakers'),
                'code' => 'SONY-XS162ES',
                'content' => 'High-quality 2-way car speakers with excellent sound clarity and power handling.',
                'meta' => 'Sony XS-162ES car speakers - Premium sound quality for your vehicle',
                'price' => 15000.00,
                'price_raw' => 15000.00,
                'brand' => 'Sony',
                'cat' => $category ? $category->id : 1,
                'stock' => 'In Stock',
            ],
            [
                'name' => 'Pioneer GM-A3702 2-Channel Bridgeable Amplifier',
                'slung' => Str::slug('Pioneer GM-A3702 2-Channel Bridgeable Amplifier'),
                'code' => 'PIO-GMA3702',
                'content' => 'Powerful 2-channel amplifier perfect for powering your car speakers.',
                'meta' => 'Pioneer GM-A3702 amplifier - Boost your car audio system',
                'price' => 25000.00,
                'price_raw' => 25000.00,
                'brand' => 'Pioneer',
                'cat' => $category ? $category->id : 1,
                'stock' => 'In Stock',
            ],
            [
                'name' => 'Kenwood KFC-W3013PS 12" Subwoofer',
                'slung' => Str::slug('Kenwood KFC-W3013PS 12" Subwoofer'),
                'code' => 'KEN-KFCW3013PS',
                'content' => '12-inch subwoofer delivering deep, powerful bass for your car.',
                'meta' => 'Kenwood 12" subwoofer - Deep bass for your vehicle',
                'price' => 18000.00,
                'price_raw' => 18000.00,
                'brand' => 'Kenwood',
                'cat' => $category ? $category->id : 1,
                'stock' => 'In Stock',
            ],
            [
                'name' => 'JBL GTO609C 6.5" Component Speaker System',
                'slung' => Str::slug('JBL GTO609C 6.5" Component Speaker System'),
                'code' => 'JBL-GTO609C',
                'content' => 'Premium component speaker system with separate woofer and tweeter.',
                'meta' => 'JBL GTO609C component speakers - Professional sound quality',
                'price' => 22000.00,
                'price_raw' => 22000.00,
                'brand' => 'JBL',
                'cat' => $category ? $category->id : 1,
                'stock' => 'In Stock',
            ],
            [
                'name' => 'Alpine CDE-172BT Car Stereo with Bluetooth',
                'slung' => Str::slug('Alpine CDE-172BT Car Stereo with Bluetooth'),
                'code' => 'ALP-CDE172BT',
                'content' => 'Modern car stereo with Bluetooth connectivity and USB input.',
                'meta' => 'Alpine CDE-172BT car stereo - Bluetooth enabled head unit',
                'price' => 30000.00,
                'price_raw' => 30000.00,
                'brand' => 'Alpine',
                'cat' => $category ? $category->id : 1,
                'stock' => 'In Stock',
            ],
        ];

        foreach ($products as $product) {
            Product::firstOrCreate(
                ['code' => $product['code']],
                $product
            );
        }
    }
}
