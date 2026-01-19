<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admins = [
            [
                'name' => 'Super Admin',
                'email' => 'admin@amanivehiclesounds.com',
                'password' => Hash::make('68252624@AVS!'),
                'position' => 'Super Administrator',
            ],
            [
                'name' => 'John Admin',
                'email' => 'john.admin@example.com',
                'password' => Hash::make('admin123'),
                'position' => 'Administrator',
            ],
            [
                'name' => 'Sarah Manager',
                'email' => 'sarah.manager@example.com',
                'password' => Hash::make('admin123'),
                'position' => 'Content Manager',
            ],
            [
                'name' => 'Mike Editor',
                'email' => 'mike.editor@example.com',
                'password' => Hash::make('admin123'),
                'position' => 'Content Editor',
            ],
            [
                'name' => 'Lisa Support',
                'email' => 'lisa.support@example.com',
                'password' => Hash::make('admin123'),
                'position' => 'Support Staff',
            ],
        ];

        foreach ($admins as $admin) {
            Admin::firstOrCreate(
                ['email' => $admin['email']],
                $admin
            );
        }
    }
}
