<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->word;

        // Generate a unique slug
        $slug = Str::slug($name . '-' . Str::random(8));

        return [
            'name' => $name,
            'slug' => $slug,
            'description' => $this->faker->sentence(15),
            'image' => $this->faker->imageUrl(),
        ];
    }
}
