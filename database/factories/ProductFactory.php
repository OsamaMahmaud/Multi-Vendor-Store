<?php

namespace Database\Factories;

use App\Models\Store;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->word;
        $slug = Str::slug($name . '-' . Str::random(8));

        // Preload stores and categories to pick from them randomly
        static $stores;
        static $categories;

        if (!$stores) {
            $stores = Store::all();
        }

        if (!$categories) {
            $categories = Category::all();
        }

        return [
            'name' => $name,
            'slug' => $slug,
            'description' => $this->faker->sentence(15),
            'image' => $this->faker->imageUrl(800, 600),
            'price' => $this->faker->randomFloat(1, 1, 499),
            'compare_price' => $this->faker->randomFloat(1, 500, 999),
            'store_id' => $stores->random()->id,
            'category_id' => $categories->random()->id,
        ];
    }
}
