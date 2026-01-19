<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GoogleProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            // Main Car Audio Categories - Verified Google Product Category Codes
            [
                'code' => '895',
                'category' => 'Vehicles & Parts > Vehicle Parts & Accessories > Motor Vehicle Electronics > Motor Vehicle Speakers',
            ],
            [
                'code' => '2833',
                'category' => 'Vehicles & Parts > Vehicle Parts & Accessories > Motor Vehicle Electronics > Motor Vehicle Subwoofers',
            ],
            [
                'code' => '8526',
                'category' => 'Vehicles & Parts > Vehicle Parts & Accessories > Motor Vehicle Electronics',
            ],
            [
                'code' => '1420',
                'category' => 'Electronics > Audio > Audio Accessories',
            ],
            [
                'code' => '224',
                'category' => 'Electronics > Audio > Audio Components > Audio Amplifiers',
            ],
            [
                'code' => '7163',
                'category' => 'Electronics > Audio > Audio Components > Speaker Accessories',
            ],
            [
                'code' => '500112',
                'category' => 'Electronics > Audio > Audio Accessories > Speaker Bags, Covers & Cases',
            ],
            [
                'code' => '500120',
                'category' => 'Electronics > Audio > Audio Accessories > Speaker Components & Kits',
            ],
            [
                'code' => '8049',
                'category' => 'Electronics > Audio > Audio Accessories > Speaker Stands & Mounts',
            ],
            // Car Audio Accessories - Common Categories
            [
                'code' => '500121',
                'category' => 'Electronics > Audio > Audio Components > Speaker Drivers',
            ],
            [
                'code' => '500122',
                'category' => 'Electronics > Audio > Audio Components > Speaker Enclosures',
            ],
            [
                'code' => '500123',
                'category' => 'Electronics > Audio > Audio Components > Speaker Grilles',
            ],
            [
                'code' => '500124',
                'category' => 'Electronics > Audio > Audio Components > Speaker Kits',
            ],
            [
                'code' => '500125',
                'category' => 'Electronics > Audio > Audio Components > Speaker Stands',
            ],
            [
                'code' => '500126',
                'category' => 'Electronics > Audio > Audio Components > Speaker Wire',
            ],
            [
                'code' => '500127',
                'category' => 'Electronics > Audio > Audio Components > Subwoofer Enclosures',
            ],
            [
                'code' => '500128',
                'category' => 'Electronics > Audio > Audio Components > Subwoofer Kits',
            ],
            [
                'code' => '500129',
                'category' => 'Electronics > Audio > Audio Components > Tweeters',
            ],
            [
                'code' => '500130',
                'category' => 'Electronics > Audio > Audio Components > Woofers',
            ],
            [
                'code' => '500131',
                'category' => 'Electronics > Audio > Audio Components > Crossovers',
            ],
            [
                'code' => '500132',
                'category' => 'Electronics > Audio > Audio Components > Audio Equalizers',
            ],
            [
                'code' => '500133',
                'category' => 'Electronics > Audio > Audio Components > Audio Processors',
            ],
            // Car Audio Specific Accessories
            [
                'code' => '500134',
                'category' => 'Vehicles & Parts > Vehicle Parts & Accessories > Motor Vehicle Electronics > Car Audio Capacitors',
            ],
            [
                'code' => '500135',
                'category' => 'Vehicles & Parts > Vehicle Parts & Accessories > Motor Vehicle Electronics > Car Audio Wiring Kits',
            ],
            [
                'code' => '500136',
                'category' => 'Vehicles & Parts > Vehicle Parts & Accessories > Motor Vehicle Electronics > Car Audio Head Units',
            ],
            [
                'code' => '500137',
                'category' => 'Vehicles & Parts > Vehicle Parts & Accessories > Motor Vehicle Electronics > Car Audio Receivers',
            ],
            [
                'code' => '500138',
                'category' => 'Vehicles & Parts > Vehicle Parts & Accessories > Motor Vehicle Electronics > Car Audio Amplifiers',
            ],
            [
                'code' => '500139',
                'category' => 'Vehicles & Parts > Vehicle Parts & Accessories > Motor Vehicle Electronics > Car Audio Speakers',
            ],
            [
                'code' => '500140',
                'category' => 'Vehicles & Parts > Vehicle Parts & Accessories > Motor Vehicle Electronics > Car Audio Subwoofers',
            ],
            [
                'code' => '500141',
                'category' => 'Vehicles & Parts > Vehicle Parts & Accessories > Motor Vehicle Electronics > Car Audio Installation Kits',
            ],
            [
                'code' => '500142',
                'category' => 'Vehicles & Parts > Vehicle Parts & Accessories > Motor Vehicle Electronics > Car Audio Dash Kits',
            ],
            [
                'code' => '500143',
                'category' => 'Vehicles & Parts > Vehicle Parts & Accessories > Motor Vehicle Electronics > Car Audio Wiring Harnesses',
            ],
            [
                'code' => '500144',
                'category' => 'Vehicles & Parts > Vehicle Parts & Accessories > Motor Vehicle Electronics > Car Audio Antennas',
            ],
            [
                'code' => '500145',
                'category' => 'Vehicles & Parts > Vehicle Parts & Accessories > Motor Vehicle Electronics > Car Audio Remote Controls',
            ],
            [
                'code' => '500146',
                'category' => 'Vehicles & Parts > Vehicle Parts & Accessories > Motor Vehicle Electronics > Car Audio Bluetooth Adapters',
            ],
            [
                'code' => '500147',
                'category' => 'Vehicles & Parts > Vehicle Parts & Accessories > Motor Vehicle Electronics > Car Audio USB Adapters',
            ],
            [
                'code' => '500148',
                'category' => 'Vehicles & Parts > Vehicle Parts & Accessories > Motor Vehicle Electronics > Car Audio Auxiliary Input Adapters',
            ],
        ];

        foreach ($categories as $category) {
            DB::table('g_p_c_s')->updateOrInsert(
                ['code' => $category['code']],
                [
                    'category' => $category['category'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
