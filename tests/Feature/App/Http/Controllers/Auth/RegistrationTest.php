<?php

use App\Http\Requests\Auth\RegisterRequest;
use Domain\Auth\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\assertAuthenticatedAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\post;

uses(RefreshDatabase::class);

it('registration screen can be rendered')
    ->get('/register')
    ->assertOk()
    ->assertSee('Регистрация')
    ->assertViewIs('auth.register');

it('validation success', function () {
    post(
        '/register',
        RegisterRequest::factory()->create()
    )->assertValid();
});

it('should fail validation on password confirm', function () {
    post(
        '/register',
        RegisterRequest::factory()->create([
            'password' => '123',
            'password_confirmation' => '1234',
        ])
    )->assertInvalid(['password']);
});

it('user created success', function () {
    $request = RegisterRequest::factory()->create();

    assertDatabaseMissing('users', [
        'email' => $request['email'],
    ]);

    post('/register', $request);

    assertDatabaseHas('users', [
        'email' => $request['email'],
    ]);
});

it('should fail validation on unique email', function () {
    $request = RegisterRequest::factory()->create();

    User::factory()->create([
        'email' => $request['email'],
    ]);

    assertDatabaseHas('users', [
        'email' => $request['email'],
    ]);

    post('/register', $request)->assertInvalid(['email']);
});

it('user authenticated after and redirected', function () {
    $request = RegisterRequest::factory()->create();

    post('/register', $request)->assertRedirect(route('home'));

    /** @var User $user */
    $user = User::query()->where('email', $request['email'])->first();

    assertAuthenticatedAs($user);
});
