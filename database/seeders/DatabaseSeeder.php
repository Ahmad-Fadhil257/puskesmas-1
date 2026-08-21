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
        // Admin Account Default untuk Demo & Testing
        User::updateOrCreate(
            ['email' => 'admin@carelink.com'],
            [
                'name' => 'Admin Puskesmas',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );
    }
}
