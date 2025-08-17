<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
       User::updateOrCreate(
            ['email' => 'admin@booksharing.com'],
            [
                'name' => 'System Admin',
                'password' => Hash::make('admin123'),
                'latitude' => 0,
                'longitude' => 0,
                'is_admin' => true,
            ]
        );

    }
}

