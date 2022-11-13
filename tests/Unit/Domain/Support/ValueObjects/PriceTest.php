<?php

declare(strict_types=1);

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertInstanceOf;
use Support\ValueObjects\Price;

it('instance created', function () {
    $price = Price::make(100000);

    assertInstanceOf(Price::class, $price);
});

it('price value correct', function () {
    $price = Price::make(100000);

    assertEquals(1000, $price->value());
});

it('raw value correct', function () {
    $price = Price::make(100000);

    assertEquals(100000, $price->raw());
});

it('currency value correct', function () {
    $price = Price::make(100000);

    assertEquals('RUB', $price->currency());
});

it('symbol value correct', function () {
    $price = Price::make(100000);

    assertEquals('₽', $price->symbol());
});

it('string value correct', function () {
    $price = Price::make(100000);

    assertEquals('1 000,00 ₽', (string) $price);
});

it('price must be more than zero', function () {
    test()->expectException(InvalidArgumentException::class);

    Price::make(-100000);
});

it('currency usd not allowed', function () {
    test()->expectException(InvalidArgumentException::class);

    Price::make(100000, 'USD');
});
