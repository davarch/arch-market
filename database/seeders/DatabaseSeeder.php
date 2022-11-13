<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Product;
use Domain\Auth\Models\User;
use Domain\Catalog\Models\Brand;
use Domain\Catalog\Models\Category;
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

        Brand::factory(20)->create();

        Category::factory(10)
            ->has(Product::factory(random_int(5, 15)))
            ->create();

        Menu::factory()->create([
            'name' => 'Главная',
            'url' => '/',
        ]);

        Menu::factory()->create([
            'name' => 'Каталог товаров',
            'url' => '/catalogue',
        ]);

        Menu::factory()->create([
            'name' => 'Корзина',
            'url' => '/cart',
        ]);
    }
}
