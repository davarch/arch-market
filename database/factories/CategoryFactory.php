<?php

namespace Database\Factories;

use Domain\Catalog\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'slug' => $this->faker->slug,
            'title' => ucfirst($this->faker->words(2, true)),
            'is_popular' => $this->faker->boolean(70),
            'sorting' => $this->faker->numberBetween(1, 999),
        ];
    }
}
