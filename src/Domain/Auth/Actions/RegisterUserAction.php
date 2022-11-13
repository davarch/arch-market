<?php

namespace Domain\Auth\Actions;

use Domain\Auth\Contracts\RegisterUserContract;
use Domain\Auth\DTO\RegisterUserDTO;
use Domain\Auth\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;

final class RegisterUserAction implements RegisterUserContract
{
    public function __invoke(RegisterUserDTO $data): User
    {
        $attributes = [
            'name' => $data->name,
            'email' => $data->email,
            'password' => Hash::make($data->password),
        ];

        return tap(
            User::query()->create($attributes),
            static fn (User $user) => event(new Registered($user))
        );
    }
}
