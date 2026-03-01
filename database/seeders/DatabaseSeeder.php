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

        User::factory()->create([
        'name' => 'Admin User',
        'email' => 'admin@example.com',
        'user_type' => 'admin',
        'password'=> bcrypt('password'),
    ]);

    // Create a regular Customer
    User::factory()->create([
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'user_type' => 'user',
        'password'=> bcrypt('password'),
    ]);
    }
}
