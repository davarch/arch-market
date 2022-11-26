<?php

declare(strict_types=1);

use App\Http\Controllers\CatalogController;
use Domain\Catalog\Models\Brand;
use Domain\Catalog\Models\Category;
use Domain\Product\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\get;

uses(RefreshDatabase::class);

it('success price filtered response', function () {
    $products = Product::factory(10)->create([
        'price' => 200,
    ]);

    $expectedProduct = Product::factory()->createOne([
        'price' => 100000,
    ]);

    $request = [
        'filters' => [
            'price' => ['from' => 999, 'to' => '1001'],
        ],
    ];

    get(action(CatalogController::class, $request))
        ->assertOk()
        ->assertSee($expectedProduct->title)
        ->assertDontSee($products->random()->first()->title);
})->group('catalog');

it('success brand filtered response', function () {
    $products = Product::factory(10)->create();

    $brand = Brand::factory()->create();

    $expectedProduct = Product::factory()->createOne([
        'brand_id' => $brand->id,
    ]);

    $request = [
        'filters' => [
            'brands' => [$brand->id => $brand->id],
        ],
    ];

    get(action(CatalogController::class, $request))
        ->assertOk()
        ->assertSee($expectedProduct->title)
        ->assertDontSee($products->random()->first()->title);
})->group('catalog');

it('success sorter response', function () {
    $category = Category::factory()->create();

    $products = Product::factory(6)->hasAttached($category)->create();

    $request = [
        'sort' => 'title',
        'category' => $category->slug,
    ];

    get(action(CatalogController::class, $request))
        ->assertOk()
        ->assertSeeTextInOrder(
            $products->sortBy('title')
                ->flatMap(fn ($item) => [$item->title])
                ->toArray()
        );
})->group('catalog');
