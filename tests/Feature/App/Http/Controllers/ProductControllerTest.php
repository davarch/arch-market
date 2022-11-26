<?php

declare(strict_types=1);

use App\Http\Controllers\ProductController;
use Domain\Product\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\get;

uses(RefreshDatabase::class);

it('success response', function () {
    $product = Product::factory()->createOne();

    get(action(ProductController::class, $product))
        ->assertOk()
        ->assertSee($product->title)
        ->assertViewIs('product.show');
})->group('product');
