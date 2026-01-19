<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiteSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (DB::table('sitesettings')->count() == 0) {
            DB::table('sitesettings')->insert([
            'sitename' => 'Amani Vehicle Sounds',
            'tagline' => 'Premium Car Audio Systems',
            'email' => 'info@amanivehiclesounds.co.ke',
            'email_one' => 'sales@amanivehiclesounds.co.ke',
            'mobile' => '+254 700 000 000',
            'mobile_one' => '+254 700 000 001',
            'mobile_one_display' => '+254 700 000 001',
            'mobile_two' => '+254 700 000 002',
            'mobile_two_display' => '+254 700 000 002',
            'url' => 'https://www.amanivehiclesounds.com',
            'location' => 'Nairobi, Kenya',
            'address' => '123 Main Street, Nairobi, Kenya',
            'facebook' => 'https://facebook.com/amanivehiclesounds',
            'twitter' => 'https://twitter.com/amanisounds',
            'instagram' => 'https://instagram.com/amanivehiclesounds',
            'youtube' => 'https://youtube.com/amanivehiclesounds',
            'welcome' => 'Welcome to Amani Vehicle Sounds - Your trusted partner for premium car audio systems.',
            ]);
        }
    }
}
