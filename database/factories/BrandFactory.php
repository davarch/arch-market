<?php

namespace Database\Factories;

use Domain\Catalog\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Brand>
 */
class BrandFactory extends Factory
{
    protected $model = Brand::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'slug' => $this->faker->slug,
            'title' => ucfirst($this->faker->words(1, true)),
            'thumbnail' => $this->faker->thumbnail('brands'),
            'is_popular' => $this->faker->boolean(70),
            'sorting' => $this->faker->numberBetween(1, 999),
        ];
    }
}
