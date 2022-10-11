<?php

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\assertAuthenticated;
use function Pest\Laravel\post;

uses(RefreshDatabase::class);

test('registration screen can be rendered')->get('/register')->assertStatus(200);
test('registration mail screen can be rendered')->get('/register-mail')->assertStatus(200);

test('new users can register', function () {
    $response = post('/register', [
        'name' => 'Test User',
        'email' => 'test@test.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    assertAuthenticated();
    $response->assertRedirect(RouteServiceProvider::HOME);
});
