<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admintest@gmail.com'],
            [
                'name' => 'Admin Test',
                'password' => bcrypt('admin12345'),
                'role' => 'admin',
                'status' => 'active',
                'email_verified_at' => now(),
            ]
        );

        User::updateOrCreate(
            ['email' => 'customertest@gmail.com'],
            [
                'name' => 'Customer Test',
                'password' => bcrypt('customer12345'),
                'role' => 'customer',
                'status' => 'active',
                'email_verified_at' => now(),
            ]
        );
    }
}
