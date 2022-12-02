<?php

declare(strict_types=1);

use App\Http\Requests\Auth\RegisterRequest;
use Domain\Auth\DTO\RegisterUserDTO;
use function PHPUnit\Framework\assertInstanceOf;

it('instance created from form request', function () {
    $form = RegisterUserDTO::from(RegisterRequest::factory()->create());

    assertInstanceOf(RegisterUserDTO::class, $form);
});
