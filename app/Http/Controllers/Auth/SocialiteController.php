<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Domain\Auth\Models\User;
use DomainException;
use Hash;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Socialite;
use Support\SessionRegenerator;
use Throwable;

class SocialiteController extends Controller
{
    /**
     * @param $provider
     * @return mixed
     */
    public function redirectToProvider($provider): mixed
    {
        try {
            return Socialite::driver($provider)->redirect();
        } catch (Throwable) {
            throw new DomainException('Произошла ошибка или драйвер не поддерживается');
        }
    }

    /**
     * @param $provider
     * @return Application|RedirectResponse|Redirector
     */
    public function handleProviderCallback($provider): Application|RedirectResponse|Redirector
    {
        if ($provider !== 'github') {
            throw new DomainException('Драйвер не поддерживается');
        }

        $user = Socialite::driver($provider)->user();
        $authUser = $this->findOrCreateUser($user, $provider);

        SessionRegenerator::run(static fn () => auth()->login($authUser, true));

        return redirect(route('home'));
    }

    /**
     * @param $user
     * @param $provider
     * @return Authenticatable
     */
    public function findOrCreateUser($user, $provider): Authenticatable
    {
        $authUser = User::query()->where('provider_id', $user->getId())->first();

        if ($authUser) {
            return $authUser;
        }

        return User::query()->create([
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'password' => Hash::make(str()->random(20)),
            'provider' => $provider,
            'provider_id' => $user->getId(),
        ]);
    }
}
