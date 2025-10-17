<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'last_access' => now(),
            ],
            [
                'name' => 'Ali Customer',
                'email' => 'ali@example.com',
                'password' => Hash::make('password'),
                'role' => 'customer',
                'last_access' => now(),
            ],
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@example.com',
                'password' => Hash::make('password'),
                'role' => 'customer',
                'last_access' => now(),
            ],
        ]);
    }
}
