<?php

namespace App\Providers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
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

        // временно
        View::composer('components.categories.index', static function (\Illuminate\View\View $view) {
            $view->with('categories', Category::popular()->limit(10)->get());
        });

        View::composer('components.products.index', static function (\Illuminate\View\View $view) {
            $view->with('products', Product::popular()->limit(8)->get());
        });

        View::composer('components.brands.index', static function (\Illuminate\View\View $view) {
            $view->with('brands', Brand::popular()->limit(6)->get());
        });
    }
}
