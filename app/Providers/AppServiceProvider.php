<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Vite;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        Vite::macro('image', fn ($asset) => $this->asset("resources/images/{$asset}"));
    }
}
