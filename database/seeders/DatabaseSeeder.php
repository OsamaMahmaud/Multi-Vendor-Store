<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin;
use App\Models\Store;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(LaratrustSeeder::class);

        $this->call(AdminsTableSeeder::class);

        Category::factory(10)->create();
        Store::factory(5)->create();
        Product::factory(100)->create();


        // Admin::factory(3)->create();

        // $this->call([UserSeeder::class]);
    }
}
