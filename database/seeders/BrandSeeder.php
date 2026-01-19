<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            [
                'name' => 'Sony',
                'slung' => Str::slug('Sony'),
            ],
            [
                'name' => 'Pioneer',
                'slung' => Str::slug('Pioneer'),
            ],
            [
                'name' => 'Kenwood',
                'slung' => Str::slug('Kenwood'),
            ],
            [
                'name' => 'JBL',
                'slung' => Str::slug('JBL'),
            ],
            [
                'name' => 'Alpine',
                'slung' => Str::slug('Alpine'),
            ],
        ];

        foreach ($brands as $brand) {
            Brand::firstOrCreate(
                ['name' => $brand['name']],
                $brand
            );
        }
    }
}
