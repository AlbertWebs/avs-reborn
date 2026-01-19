<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SEOSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (DB::table('seosettings')->count() == 0) {
            DB::table('seosettings')->insert([
                'sitename' => 'Amani Vehicle Sounds',
                'intro' => 'Premium Car Audio Systems in Kenya',
                'welcome' => 'Welcome to Amani Vehicle Sounds - Your trusted partner for premium car audio systems, speakers, amplifiers, and professional installation services in Kenya.',
                'url' => 'https://www.amanivehiclesounds.com',
            ]);
        }
    }
}
