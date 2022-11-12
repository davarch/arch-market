<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Product;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     *
     * @throws Exception
     */
    public function definition(): array
    {
        return [
            'slug' => fake()->slug,
            'title' => ucfirst(fake()->words(2, true)),
            'thumbnail' => $this->faker->thumbnail('products'),
            'price' => fake()->numberBetween(1000, 100000),
            'is_popular' => fake()->boolean(20),
            'sorting' => $this->faker->numberBetween(1, 999),
            'brand_id' => Brand::query()->inRandomOrder()->value('id'),
        ];
    }
}
