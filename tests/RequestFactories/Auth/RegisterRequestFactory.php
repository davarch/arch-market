<?php

namespace Tests\RequestFactories\Auth;

use Worksome\RequestFactories\RequestFactory;

class RegisterRequestFactory extends RequestFactory
{
    public function definition(): array
    {
        $password = 'pass%worD$123';

        return [
            'email' => $this->faker->email,
            'name' => $this->faker->name,
            'password' => $password,
            'password_confirmation' => $password,
        ];
    }
}
