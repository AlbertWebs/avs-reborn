<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SEOSettingsSeeder::class,
            SiteSettingsSeeder::class,
            BrandSeeder::class,
            CategorySeeder::class,
            GoogleProductCategorySeeder::class,
            UserSeeder::class,
            AdminSeeder::class,
            ProductSeeder::class,
            SliderSeeder::class,
            BannerSeeder::class,
            TagSeeder::class,
            BlogSeeder::class,
            PortfolioSeeder::class,
            TestimonialSeeder::class,
            ServiceSeeder::class,
            CouponCodeSeeder::class,
        ]);
    }
}
