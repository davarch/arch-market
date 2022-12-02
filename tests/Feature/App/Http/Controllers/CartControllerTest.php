<?php

declare(strict_types=1);

use App\Http\Controllers\CartController;
use Domain\Cart\CartManager;
use Domain\Product\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\delete;
use function Pest\Laravel\get;
use function Pest\Laravel\post;
use function PHPUnit\Framework\assertEquals;

uses(RefreshDatabase::class);

beforeEach(function () {
    CartManager::fake();
});

it('is empty cart', function () {
    get(action([CartController::class, 'index']))
        ->assertOk()
        ->assertViewIs('cart.index')
        ->assertViewHas('items', collect([]));
})->group('cart');

it('is not empty cart', function () {
    $product = Product::factory()->create();

    cart()->add($product, 5);

    get(action([CartController::class, 'index']))
        ->assertOk()
        ->assertViewIs('cart.index')
        ->assertViewHas('items', cart()->items());
})->group('cart');

it('added success', function () {
    $product = Product::factory()->create();

    assertEquals(0, cart()->count());

    post(
        action([CartController::class, 'add'], $product),
        [
            'quantity' => 5,
        ]
    );

    assertEquals(5, cart()->count());
})->group('cart');

it('quantity changed', function () {
    $product = Product::factory()->create();

    cart()->add($product, 5);

    assertEquals(5, cart()->count());

    post(
        action([CartController::class, 'quantity'], cart()->items()->first()),
        [
            'quantity' => 15,
        ]
    );

    assertEquals(15, cart()->count());
})->group('cart');

it('deleted success', function () {
    $product = Product::factory()->create();

    cart()->add($product, 5);

    assertEquals(5, cart()->count());

    delete(
        action([CartController::class, 'delete'], cart()->items()->first()),
    );

    assertEquals(0, cart()->count());
})->group('cart');

it('truncate success', function () {
    $product = Product::factory()->create();

    cart()->add($product, 5);

    assertEquals(5, cart()->count());

    delete(
        action([CartController::class, 'truncate'])
    );

    assertEquals(0, cart()->count());
})->group('cart');
