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
    // User::factory(10)->create();

    // Si no tienes modelo User, comentar lo siguiente:
    // User::factory()->create([
    //     'name' => 'Test User',
    //     'email' => 'test@example.com',
    // ]);

    // Seeders de tu proyecto
    $this->call([
        GroupSeeder::class,
        StudentSeeder::class,
    ]);
}
}
