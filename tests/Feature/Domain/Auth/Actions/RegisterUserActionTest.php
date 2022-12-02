<?php

declare(strict_types=1);

use App\Http\Requests\Auth\RegisterRequest;
use Domain\Auth\Contracts\RegisterUserContract;
use Domain\Auth\DTO\RegisterUserDTO;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;

it('success user created', function () {
    $request = RegisterRequest::factory()->create();

    assertDatabaseMissing('users', [
        'email' => $request['email'],
    ]);

    $action = app(RegisterUserContract::class);

    $action(RegisterUserDTO::from($request));

    assertDatabaseHas('users', [
        'email' => $request['email'],
    ]);
});
