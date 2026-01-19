<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CouponCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $coupons = [
            [
                'title' => 'Welcome Discount',
                'code' => 'WELCOME10',
                'status' => 1,
                'expired_at' => Carbon::now()->addDays(30),
                'value' => 10.00,
            ],
            [
                'title' => 'New Customer',
                'code' => 'NEWCUSTOMER15',
                'status' => 1,
                'expired_at' => Carbon::now()->addDays(60),
                'value' => 15.00,
            ],
            [
                'title' => 'Holiday Special',
                'code' => 'HOLIDAY20',
                'status' => 1,
                'expired_at' => Carbon::now()->addDays(90),
                'value' => 20.00,
            ],
            [
                'title' => 'Bulk Purchase',
                'code' => 'BULK25',
                'status' => 1,
                'expired_at' => Carbon::now()->addDays(120),
                'value' => 25.00,
            ],
            [
                'title' => 'VIP Member',
                'code' => 'VIP30',
                'status' => 1,
                'expired_at' => Carbon::now()->addDays(365),
                'value' => 30.00,
            ],
        ];

        foreach ($coupons as $coupon) {
            DB::table('coupon_codes')->updateOrInsert(
                ['code' => $coupon['code']],
                $coupon
            );
        }
    }
}
