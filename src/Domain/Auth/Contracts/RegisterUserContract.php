<?php

namespace Domain\Auth\Contracts;

use Domain\Auth\DTO\RegisterUserDTO;
use Domain\Auth\Models\User;

interface RegisterUserContract
{
    public function __invoke(RegisterUserDTO $data): User;
}
