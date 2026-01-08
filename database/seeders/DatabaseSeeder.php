<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create single user account
        User::updateOrCreate(
            ['email' => 'arman.alawaf@gmail.com'],
            [
                'name' => 'Arman Alawaf',
                'email' => 'arman.alawaf@gmail.com',
                'password' => Hash::make('135792468'),
                'email_verified_at' => now(),
            ]
        );
    }
}
