<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\SocialiteController;
use Domain\Auth\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Socialite\Contracts\User as SocialiteUser;
use Mockery\MockInterface;
use function Pest\Laravel\assertAuthenticated;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\get;
use function Pest\Laravel\mock;
use function Pest\Laravel\withoutExceptionHandling;

uses(RefreshDatabase::class);

it('github redirect success', function () {
    get(
        action(
            [SocialiteController::class, 'redirectToProvider'],
            ['provider' => 'github']
        )
    )->assertRedirectContains('github.com');
})->group('socialite');

it('driver not found exception', function () {
    withoutExceptionHandling()
        ->get(
            action(
                [SocialiteController::class, 'redirectToProvider'],
                ['provider' => 'vk']
            )
        );

    withoutExceptionHandling()
        ->get(
            action(
                [SocialiteController::class, 'handleProviderCallback'],
                ['provider' => 'vk']
            )
        );
})
    ->group('socialite')
    ->expectException(DomainException::class);

it('github callback created user success', function () {
    $githubId = str()->random(10);

    assertDatabaseMissing('users', [
        'provider_id' => $githubId,
    ]);

    mockSocialiteCallback($githubId);

    get(
        action(
            [SocialiteController::class, 'handleProviderCallback'],
            ['provider' => 'github']
        )
    )->assertRedirect(route('home'));

    assertAuthenticated();

    assertDatabaseHas('users', [
        'provider_id' => $githubId,
    ]);
})->group('socialite');

it('authenticated by existing user', function () {
    $githubId = str()->random(10);

    User::factory()->create([
        'provider' => 'github',
        'provider_id' => $githubId,
    ]);

    assertDatabaseHas('users', [
        'provider_id' => $githubId,
    ]);

    mockSocialiteCallback($githubId);

    get(
        action(
            [SocialiteController::class, 'handleProviderCallback'],
            ['provider' => 'github']
        )
    )->assertRedirect(route('home'));

    assertAuthenticated();
})->group('socialite');

function mockSocialiteCallback(string $githubId): MockInterface
{
    $user = mock(SocialiteUser::class, function (MockInterface $m) use ($githubId) {
        $m->shouldReceive('getId')
            ->andReturn($githubId);

        $m->shouldReceive('getName')
            ->andReturn(str()->random(10));

        $m->shouldReceive('getToken')
            ->andReturn(str()->random(10));

        $m->shouldReceive('getEmail')
            ->andReturn('testing@cutcode.ru');
    });

    Socialite::shouldReceive('driver->user')
        ->once()
        ->andReturn($user);

    return $user;
}
