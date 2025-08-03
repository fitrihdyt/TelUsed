<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'nama' => 'Admin',
            'email' => 'admin@gmail.com',
            'no_telepon' => '081234567890',
            'password' => Hash::make('password'),
            'level' => 'admin',
        ]);

        // User
        User::create([
            'nama' => 'User',
            'email' => 'user@gmail.com',
            'no_telepon' => '081212121212',
            'password' => Hash::make('password'),
            'level' => 'user',
        ]);

        User::create([
            'nama' => 'Ye',
            'email' => 'ye@gmail.com',
            'password' => bcrypt('123123123'),
            'level' => 'user'
        ]);

        User::create([
            'nama' => 'Zal',
            'email' => 'zal@gmail.com',
            'password' => bcrypt('123123123'),
            'level' => 'user'
        ]);

    }
}