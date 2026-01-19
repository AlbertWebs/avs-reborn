<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonials = [
            [
                'name' => 'James Kariuki',
                'content' => 'Excellent service and quality products! The installation was professional and the sound quality is amazing.',
                'company' => 'Kariuki Motors',
                'service' => 'Car Audio Installation',
                'position' => 'Business Owner',
                'rating' => 5,
            ],
            [
                'name' => 'Mary Wanjiku',
                'content' => 'I love my new car speakers! The staff was very helpful in choosing the right products for my vehicle.',
                'company' => 'Personal',
                'service' => 'Product Purchase',
                'position' => 'Customer',
                'rating' => 5,
            ],
            [
                'name' => 'Peter Ochieng',
                'content' => 'Best car audio shop in Nairobi! Great prices and professional installation. Highly recommended!',
                'company' => 'Ochieng Transport',
                'service' => 'Fleet Installation',
                'position' => 'Fleet Manager',
                'rating' => 5,
            ],
            [
                'name' => 'Grace Muthoni',
                'content' => 'The subwoofer I bought sounds incredible! Great customer service and fast delivery.',
                'company' => 'Personal',
                'service' => 'Product Purchase',
                'position' => 'Customer',
                'rating' => 4,
            ],
            [
                'name' => 'David Kamau',
                'content' => 'Professional installation team and quality products. My car sounds like a concert hall now!',
                'company' => 'Kamau Enterprises',
                'service' => 'Complete Audio System',
                'position' => 'CEO',
                'rating' => 5,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            DB::table('testimonial')->updateOrInsert(
                ['name' => $testimonial['name']],
                $testimonial
            );
        }
    }
}
