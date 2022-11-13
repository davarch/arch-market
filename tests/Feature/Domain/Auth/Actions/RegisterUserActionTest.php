<?php

declare(strict_types=1);

use App\Http\Requests\Auth\RegisterRequest;
use Domain\Auth\Contracts\RegisterUserContract;
use Domain\Auth\DTO\RegisterUserDTO;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

it('success user created', /** @throws UnknownProperties */ function () {
    $request = RegisterRequest::factory()->create();

    assertDatabaseMissing('users', [
        'email' => $request['email'],
    ]);

    $action = app(RegisterUserContract::class);

    $action(new RegisterUserDTO($request));

    assertDatabaseHas('users', [
        'email' => $request['email'],
    ]);
});
