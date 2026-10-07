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
        // Admin staff user for managing bookings
        User::updateOrCreate(
            ['email' => 'admin@livocarelabs.in'],
            [
                'name' => 'Livocare Lab Admin',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),
            ]
        );

        $this->call([
            MedicalPackageSeeder::class,
        ]);
    }
}
