<?php

namespace App\Providers;

use App\View\Composers\MenuComposer;
use Illuminate\Support\ServiceProvider;
use View;
use Vite;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Vite::macro('image', fn ($asset) => $this->asset("resources/images/{$asset}"));

        View::composer('components.menu', MenuComposer::class);
        View::composer('components.mobile-menu', MenuComposer::class);
    }
}
