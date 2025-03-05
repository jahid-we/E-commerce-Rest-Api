<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'email' => 'user@example.com',
            'role' => 'user',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'email' => 'ordinaryadmin@example.com',
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'email' => 'superadmin@example.com',
            'role' => 'superadmin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
