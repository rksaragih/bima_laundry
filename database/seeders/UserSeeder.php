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
            ['username' => 'Deva'],
            [ 
                'password' => bcrypt('718191'),
                'role' => 'Admin',
            ]
        );

        User::firstOrCreate(
            ['username' => 'Bimatirta'],
            [
                'password' => bcrypt('10Feb2023'),
                'role' => 'Kasir',
            ]
        );
    }
}
