<?php

namespace Domain\Auth\Providers;

use Domain\Auth\Actions\RegisterUserAction;
use Domain\Auth\Contracts\RegisterUserContract;
use Illuminate\Support\ServiceProvider;

class ActionServiceProvider extends ServiceProvider
{
    public array $bindings = [
        RegisterUserContract::class => RegisterUserAction::class,
    ];
}
