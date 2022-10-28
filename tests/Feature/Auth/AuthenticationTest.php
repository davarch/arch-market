<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\assertAuthenticated;
use function Pest\Laravel\assertGuest;
use function Pest\Laravel\post;

uses(RefreshDatabase::class);

test('login screen can be rendered')->get('login')->assertStatus(200);

test('users can authenticate using the login screen', function () {
    $user = User::factory()->create([
        'password' => \Hash::make('pass%worD$123'),
    ]);

    $response = post('/login', [
        'email' => $user->email,
        'password' => 'pass%worD$123',
    ]);

    assertAuthenticated();
    $response->assertRedirect(RouteServiceProvider::HOME);
});

test('users can not authenticate with invalid password', function () {
    $user = User::factory()->create();

    post('/login', [
        'email' => $user->email,
        'password' => 'pass%worD$123',
    ]);

    assertGuest();
});
