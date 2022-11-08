<?php

namespace Domain\Auth\Contracts;

interface RegisterUserContract
{
    public function __invoke(array $data): void;
}
