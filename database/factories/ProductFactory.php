<?php

namespace Database\Factories;

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
            'title' => fake()->text(10),
            'description' => fake()->text(),
            'category_id' => random_int(1, 10),
        ];
    }
}
