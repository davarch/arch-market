<?php

namespace App\Providers;

use App\Filters\BrandFilter;
use App\Filters\OptionFilter;
use App\Filters\PriceFilter;
use Domain\Catalog\Filters\FilterManager;
use Domain\Catalog\Sorters\Sorter;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\ServiceProvider;

class CatalogServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(FilterManager::class);
    }

    /**
     * @throws BindingResolutionException
     */
    public function boot(): void
    {
        $this->app->make(FilterManager::class)->registerFilters([
            new PriceFilter(),
            new BrandFilter(),
            new OptionFilter(),
        ]);

        $this->app->bind(Sorter::class, function () {
            return new Sorter([
                'title',
                'price',
            ]);
        });
    }
}
