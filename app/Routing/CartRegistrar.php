<?php

declare(strict_types=1);

namespace App\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\CartController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

final class CartRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware('web')
            ->controller(CartController::class)
            ->prefix('cart')
            ->as('cart.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('/{product}/add', 'add')->name('add');
                Route::post('/{item}/quantity', 'quantity')->name('quantity');
                Route::delete('/{item}/delete', 'delete')->name('delete');
                Route::delete('/truncate', 'truncate')->name('truncate');
            });
    }
}
