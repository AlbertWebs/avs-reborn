<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banners = [
            [
                'name' => 'Homepage Banner',
                'section' => 'homepage',
            ],
            [
                'name' => 'Products Banner',
                'section' => 'products',
            ],
            [
                'name' => 'Category Banner',
                'section' => 'category',
            ],
            [
                'name' => 'Sidebar Banner',
                'section' => 'sidebar',
            ],
            [
                'name' => 'Footer Banner',
                'section' => 'footer',
            ],
        ];

        foreach ($banners as $banner) {
            DB::table('banners')->updateOrInsert(
                ['name' => $banner['name']],
                $banner
            );
        }
    }
}
