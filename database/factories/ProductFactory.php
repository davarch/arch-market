<?php

namespace Database\Factories;

use Domain\Catalog\Models\Brand;
use Domain\Product\Models\Product;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * @return array<string, mixed>
     *
     * @throws Exception
     */
    public function definition(): array
    {
        return [
            'slug' => $this->faker->slug,
            'title' => ucfirst($this->faker->words(2, true)),
            'thumbnail' => $this->faker->thumbnail('products'),
            'price' => $this->faker->numberBetween(1000, 1000000),
            'is_popular' => $this->faker->boolean(20),
            'sorting' => $this->faker->numberBetween(1, 999),
            'brand_id' => Brand::query()->inRandomOrder()->value('id'),
            'text' => $this->faker->text(),
            'quantity' => $this->faker->numberBetween(0, 20),
        ];
    }
}
