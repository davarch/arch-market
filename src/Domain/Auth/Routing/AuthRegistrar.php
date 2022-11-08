<?php

namespace Domain\Auth\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\SocialiteController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

final class AuthRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware('web')->group(function () {
            Route::middleware('guest')->group(function () {
                Route::controller(RegisteredUserController::class)->group(function () {
                    Route::get('register', 'create')->name('register');
                    Route::post('register', 'store')->middleware('throttle:auth');
                });

                Route::controller(AuthenticatedSessionController::class)->group(function () {
                    Route::get('login', 'create')->name('login');
                    Route::post('login', 'store')->middleware('throttle:auth');
                });

                Route::controller(PasswordResetLinkController::class)->group(function () {
                    Route::get('forgot-password', 'create')->name('password.request');
                    Route::post('forgot-password', 'store')->name('password.email');
                });

                Route::controller(NewPasswordController::class)->group(function () {
                    Route::get('reset-password/{token}', 'create')->name('password.reset');
                    Route::post('reset-password', 'store')->name('password.update');
                });

                Route::controller(SocialiteController::class)->group(function () {
                    Route::get('login/{provider}', 'redirectToProvider')->name('login.provider');
                    Route::get('{provider}/callback', 'handleProviderCallback');
                });
            });

            Route::middleware('auth')->group(function () {
                Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
            });
        });
    }
}
