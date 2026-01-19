<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => 'Car Audio Installation',
                'content' => 'Professional installation of car audio systems by certified technicians. We ensure proper wiring and optimal sound quality.',
            ],
            [
                'name' => 'Speaker Replacement',
                'content' => 'Expert speaker replacement services for all vehicle types. We help you choose the right speakers for your car.',
            ],
            [
                'name' => 'Amplifier Installation',
                'content' => 'Professional amplifier installation to boost your car audio system. Proper power distribution and wiring included.',
            ],
            [
                'name' => 'Subwoofer Installation',
                'content' => 'Custom subwoofer installation with proper enclosure design. Deep bass for your vehicle audio system.',
            ],
            [
                'name' => 'Car Stereo Upgrade',
                'content' => 'Upgrade your car stereo with modern features like Bluetooth, USB, and navigation. Professional installation guaranteed.',
            ],
        ];

        foreach ($services as $service) {
            DB::table('services')->updateOrInsert(
                ['name' => $service['name']],
                $service
            );
        }
    }
}
