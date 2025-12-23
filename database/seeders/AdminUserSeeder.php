<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::updateOrCreate(
            ['email' => 'kagziinfotech@gmail.com'],
            [
                'name' => 'Admin',
                'email' => 'kagziinfotech@gmail.com',
                'phone' => '9601167108',
                'password' => Hash::make('Plmnkoijb1@3$5'),
                'is_admin' => true,
                'email_verified_at' => now(),
            ]
        );
    }
}
