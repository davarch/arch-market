<?php

namespace Tests\Feature\Auth;

use Domain\Auth\Models\User;
use Exception;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

uses(RefreshDatabase::class);

it('reset password link screen can be rendered')
    ->get('/forgot-password')
    ->assertOk()
    ->assertSee('Восстановить пароль')
    ->assertViewIs('auth.forgot-password');

it('reset password link can be requested', /** @throws Exception */ function () {
    Notification::fake();

    $user = User::factory()->create();

    post('/forgot-password', ['email' => $user->email]);

    Notification::assertSentTo($user, ResetPassword::class);
});

it('reset password screen can be rendered', /** @throws Exception */ function () {
    Notification::fake();

    $user = User::factory()->create();

    post('/forgot-password', ['email' => $user->email]);

    Notification::assertSentTo($user, ResetPassword::class, static function ($notification) {
        get('/reset-password/'.$notification->token)->assertStatus(200);

        return true;
    });
});

it('password can be reset with valid token', /** @throws Exception */ function () {
    Notification::fake();

    $user = User::factory()->create();

    post('/forgot-password', ['email' => $user->email]);

    Notification::assertSentTo($user, ResetPassword::class, static function ($notification) use ($user) {
        post('/reset-password', [
            'token' => $notification->token,
            'email' => $user->email,
            'password' => 'pass%worD$123',
            'password_confirmation' => 'pass%worD$123',
        ])->assertSessionHasNoErrors();

        return true;
    });
});
