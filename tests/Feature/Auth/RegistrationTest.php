<?php

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\assertAuthenticated;
use function Pest\Laravel\post;

uses(RefreshDatabase::class);

test('registration screen can be rendered')->get('/register')->assertStatus(200);

test('new users can register', function () {
    $response = post('/register', [
        'name' => 'Test User',
        'email' => 'test@cutcode.com',
        'password' => 'pass%worD$123',
        'password_confirmation' => 'pass%worD$123',
    ]);

    assertAuthenticated();
    $response->assertRedirect(RouteServiceProvider::HOME);
});
