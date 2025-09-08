<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@sv.com',
            'password' => Hash::make('passwordz'), // You should change this in production
            'role' => 'admin',
            'profile_picture' => null,
            'theme_preference' => 'dark',
            'email_verified_at' => now(),
        ]);

        // Create regular test user
        User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
            'profile_picture' => null,
            'theme_preference' => 'dark',
            'email_verified_at' => now(),
        ]);

        // You can add more seeders here
        $this->call([
            // CategorySeeder::class,
            // ProductSeeder::class,
            // AuctionSeeder::class,
        ]);
    }
}