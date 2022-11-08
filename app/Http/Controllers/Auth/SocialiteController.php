<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Domain\Auth\Models\User;
use DomainException;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Socialite;
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

        auth()->login($authUser, true);

        return redirect(RouteServiceProvider::HOME);
    }

    /**
     * @param $user
     * @param $provider
     * @return Builder|Model|object
     */
    public function findOrCreateUser($user, $provider): Authenticatable
    {
        $authUser = User::query()->where('provider_id', $user->id)->first();

        if ($authUser) {
            return $authUser;
        }

        return User::query()->create([
            'name' => $user->name,
            'email' => $user->email,
            'password' => bcrypt($user->token),
            'provider' => $provider,
            'provider_id' => $user->id,
        ]);
    }
}
