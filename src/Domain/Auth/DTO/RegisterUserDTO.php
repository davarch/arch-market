<?php

declare(strict_types=1);

namespace Domain\Auth\DTO;

use Spatie\LaravelData\Data;

final class RegisterUserDTO extends Data
{
    public function __construct(
        public readonly string $name,

        public readonly string $email,

        public readonly string $password,
    ) {
    }
}
