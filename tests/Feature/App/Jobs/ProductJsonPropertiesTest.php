<?php

declare(strict_types=1);

use App\Jobs\ProductJsonProperties;
use Domain\Product\Models\Product;
use Domain\Product\Models\Property;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function PHPUnit\Framework\assertEmpty;
use function PHPUnit\Framework\assertNotEmpty;

uses(RefreshDatabase::class);

it('created json properties', function () {
    $queue = Queue::getFacadeRoot();

    Queue::fake([ProductJsonProperties::class]);

    $properties = Property::factory(10)->create();

    $product = Product::factory()
        ->hasAttached($properties, function () {
            return ['value' => ucfirst(fake()->word())];
        })
        ->create();

    assertEmpty($product->json_properties);

    Queue::swap($queue);

    ProductJsonProperties::dispatchSync($product);

    $product->refresh();

    assertNotEmpty($product->json_properties);
})->group('jobs');
