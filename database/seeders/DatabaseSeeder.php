<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Size;
use App\Models\User;
use App\Models\UserProfile;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(5)->create();
        User::factory()->admin()->create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
        ]);

        UserProfile::factory()->create([
            'user_id' => 1,
        ]);

        Category::create([
            'category_name' => 'New Arrivals',
        ]);

        Category::create([
            'category_name' => 'Accessories',
        ]);

        Category::create([
            'category_name' => 'Workspace',
        ]);

        Size::create([
            'size_name' => 'S',
        ]);

        Size::create([
            'size_name' => 'M',
        ]);

        Size::create([
            'size_name' => 'L',
        ]);

        Size::create([
            'size_name' => 'XL',
        ]);

        Product::factory(40)->create();
    }
}
