<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear usuario de admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
        ]);

        // Crear usuario de prueba
        User::create([
            'name' => 'Usuario de Prueba',
            'email' => 'user@example.com',
            'password' => Hash::make('password123'),
        ]);

        // Crear usuarios aleatorios adicionales
        User::factory(5)->create();
    }
}
