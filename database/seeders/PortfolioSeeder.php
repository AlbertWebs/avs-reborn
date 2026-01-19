<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $portfolios = [
            [
                'name' => 'Premium SUV Audio System',
                'content' => 'Complete audio system installation for a luxury SUV featuring Sony speakers and Pioneer amplifier.',
            ],
            [
                'name' => 'Sports Car Sound Upgrade',
                'content' => 'High-performance audio upgrade for a sports car with JBL component speakers and Alpine subwoofer.',
            ],
            [
                'name' => 'Family Car Audio Installation',
                'content' => 'Family-friendly audio system with Kenwood speakers and integrated Bluetooth connectivity.',
            ],
            [
                'name' => 'Commercial Vehicle Audio',
                'content' => 'Professional audio system installation for commercial vehicles with durable components.',
            ],
            [
                'name' => 'Custom Audio Build',
                'content' => 'Custom audio build featuring multiple amplifiers, custom subwoofer enclosure, and premium speakers.',
            ],
        ];

        foreach ($portfolios as $portfolio) {
            DB::table('portfolio')->updateOrInsert(
                ['name' => $portfolio['name']],
                $portfolio
            );
        }
    }
}
