<?php

namespace Database\Seeders;

use App\Models\Category;
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
        'email' => 'admin@mail.com',
        'user_type' => 'admin',
        'password'=> bcrypt('password'),
    ]);

    // Create a regular Customer
    User::factory()->create([
        'name' => 'John Doe',
        'email' => 'johnny@mail.com',
        'user_type' => 'user',
        'password'=> bcrypt('password'),
    ]);

    User::factory()->create([
        'name' => 'Jane Doe',
        'email' => 'jannet@mail.com',
        'user_type' => 'user',
        'password'=> bcrypt('password'),
    ]);

    Category::factory()->create([
        'category' => 'Accessories',
    ]);

    Category::factory()->create([
        'category' => 'Beauty',
    ]);

    Category::factory()->create([
        'category' => 'Books',
    ]);

    Category::factory()->create([
        'category' => 'Clothing',
    ]);

    Category::factory()->create([
        'category' => 'Electronics',
    ]);

    Category::factory()->create([
        'category' => 'Kitchen',
    ]);

    Category::factory()->create([
        'category' => 'Sports',
    ]);

    Category::factory()->create([
        'category' => 'Toys',
    ]);

    }
}
