<?php

namespace Database\Seeders;

use Domain\Auth\Models\User;
use Domain\Catalog\Models\Brand;
use Domain\Catalog\Models\Category;
use Domain\Product\Models\Option;
use Domain\Product\Models\OptionValue;
use Domain\Product\Models\Product;
use Domain\Product\Models\Property;
use Exception;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     *
     * @throws Exception
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $properties = Property::factory(10)->create();

        Option::factory(2)->create();

        $optionValue = OptionValue::factory(10)->create();

        Brand::factory(20)->create();

        Category::factory(10)
            ->has(
                Product::factory(random_int(5, 15))
                    ->hasAttached($optionValue)
                    ->hasAttached($properties, function () {
                        return ['value' => ucfirst(fake()->word())];
                    })
            )
            ->create();
    }
}
