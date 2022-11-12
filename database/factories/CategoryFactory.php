<?php

namespace Database\Factories;

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
        return [
            'slug' => fake()->slug,
            'title' => ucfirst(fake()->words(2, true)),
            'is_popular' => fake()->boolean(70),
            'sorting' => $this->faker->numberBetween(1, 999),
        ];
    }
}
