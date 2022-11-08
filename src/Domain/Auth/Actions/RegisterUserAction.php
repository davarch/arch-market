<?php

namespace Domain\Auth\Actions;

use Domain\Auth\Contracts\RegisterUserContract;
use Domain\Auth\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;

final class RegisterUserAction implements RegisterUserContract
{
    public function __invoke(array $data): void
    {
        $user = User::query()->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        event(new Registered($user));

        auth()->login($user);
    }
}
