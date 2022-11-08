<?php

use App\Http\Requests\Auth\RegisterRequest;
use App\Providers\RouteServiceProvider;
use Domain\Auth\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\assertAuthenticatedAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\post;

uses(RefreshDatabase::class);

test('registration screen can be rendered')
    ->get('/register')
    ->assertOk()
    ->assertSee('Регистрация')
    ->assertViewIs('auth.register');

test('new users can register', function () {
    Event::fake();
    Notification::fake();

    $request = RegisterRequest::factory()->create();

    assertDatabaseMissing('users', [
        'email' => $request['email'],
    ]);

    $response = post('/register', $request);

    $response->assertValid();

    assertDatabaseHas('users', [
        'email' => $request['email'],
    ]);

    $user = User::query()->where('email', $request['email'])->first();

    Event::assertDispatched(Registered::class);
    // Event::assertListening(Registered::class, SendEmailNewUserListener::class);

//    $event = new Registered($user);
//    $listener = new SendEmailNewUserListener();
//    $listener->handle($event);

    // Notification::assertSentTo($user, NewUserNotification::class);

    assertAuthenticatedAs($user);

    $response->assertRedirect(RouteServiceProvider::HOME);
});
