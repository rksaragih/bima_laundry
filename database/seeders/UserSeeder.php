<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['username' => 'admin'],
            [
                'email' => 'admin@gmail.com',  
                'password' => bcrypt('admin123'),
                'role' => 'Admin',
            ]
        );

        User::firstOrCreate(
            ['username' => 'kasir'],
            [
                'email' => 'kasir@gmail.com',
                'password' => bcrypt('kasir123'),
                'role' => 'Kasir',
            ]
        );
    }
}
