<?php

declare(strict_types=1);

namespace Domain\Auth\DTO;

use Spatie\DataTransferObject\DataTransferObject;

final class RegisterUserDTO extends DataTransferObject
{
    public readonly string $name;

    public readonly string $email;

    public readonly string $password;
}
