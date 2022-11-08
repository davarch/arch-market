<?php

namespace Tests\RequestFactories\Auth;

use Worksome\RequestFactories\RequestFactory;

class LoginRequestFactory extends RequestFactory
{
    public function definition(): array
    {
        return [
            'email' => $this->faker->email,
            'password' => $this->faker->password(18),
        ];
    }
}
