<?php

declare(strict_types=1);

use Domain\Product\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\get;

uses(RefreshDatabase::class);

it('generated success', function () {
    Storage::fake('images');

    $size = '500x500';
    $method = 'resize';
    $storage = Storage::disk('images');

    config()->set('thumbnail', ['allowed_size' => [$size]]);

    $product = Product::factory()->create();

    $response = get($product->makeThumbnail($size, $method));

    $response->assertOk();

    $storage->assertExists("products/$method/$size/".File::basename($product->thumbnail));
})->group('images');
