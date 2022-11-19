<?php

use App\Http\Requests\Auth\LoginRequest;
use Domain\Auth\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertAuthenticatedAs;
use function Pest\Laravel\assertGuest;
use function Pest\Laravel\post;

uses(RefreshDatabase::class);

it('login screen can be rendered')
    ->get('login')
    ->assertOk()
    ->assertSee('Вход в аккаунт')
    ->assertViewIs('auth.login');

it('users can authenticate using the login screen', function () {
    $password = 'pass%worD$123';

    $user = User::factory()->create([
        'password' => \Hash::make($password),
    ]);

    $request = LoginRequest::factory()->create([
        'email' => $user->email,
        'password' => $password,
    ]);

    $response = post('/login', $request);
    $response->assertValid();

    assertAuthenticatedAs($user);
    $response->assertRedirect(route('home'));
});

it('users can not authenticate with invalid password', function () {
    $user = User::factory()->create();

    post('/login', LoginRequest::factory()->create([
        'email' => $user->email,
    ]));

    assertGuest();
});

it('users can be logout', function () {
    $user = User::factory()->create();

    actingAs($user)->post('/logout');

    assertGuest();
});
