<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Book;
use Illuminate\Support\Facades\Hash;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure admin exists
        $admin = User::firstOrCreate(
            ['email' => 'admin@booksharing.com'],
            [
                'name' => 'System Admin',
                'password' => Hash::make('admin123'),
                'latitude' => 23.8103,
                'longitude' => 90.4125,
                'is_admin' => true,
            ]
        );

        // 4 demo users
        $users = User::factory()->count(4)->create();

        // 8 demo books
        Book::factory()->count(8)->create();
    }
}

