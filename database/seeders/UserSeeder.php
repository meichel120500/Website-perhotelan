<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name'     => 'Admin PPKD',
            'email'    => 'admin@ppkdhotel.com',
            'password' => Hash::make('admin123'),
            'role'     => 'admin',
        ]);

        // Resepsionis 1
        User::create([
            'name'     => 'Resepsionis 1',
            'email'    => 'resepsionis@ppkdhotel.com',
            'password' => Hash::make('resep123'),
            'role'     => 'resepsionis',
        ]);
    }
}
