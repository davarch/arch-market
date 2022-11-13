<?php

declare(strict_types=1);

use App\Http\Requests\Auth\RegisterRequest;
use Domain\Auth\DTO\RegisterUserDTO;
use function PHPUnit\Framework\assertInstanceOf;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

it('instance created from form request', /** @throws UnknownProperties */ function () {
    $form = new RegisterUserDTO(RegisterRequest::factory()->create());

    assertInstanceOf(RegisterUserDTO::class, $form);
});
