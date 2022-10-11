<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Socialite;

class SocialiteController extends Controller
{
    /**
     * @param $provider
     * @return mixed
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * @param $provider
     * @return Application|RedirectResponse|Redirector
     */
    public function handleProviderCallback($provider): Application|RedirectResponse|Redirector
    {
        $user = Socialite::driver($provider)->user();
        $authUser = $this->findOrCreateUser($user, $provider);

        auth()->login($authUser, true);

        return redirect(RouteServiceProvider::HOME);
    }

    /**
     * @param $user
     * @param $provider
     * @return User
     */
    public function findOrCreateUser($user, $provider): User
    {
        $authUser = User::where('provider_id', $user->id)->first();

        if ($authUser) {
            return $authUser;
        }

        return User::create([
            'name' => $user->name,
            'email' => $user->email,
            'password' => bcrypt($user->token),
            'provider' => $provider,
            'provider_id' => $user->id,
        ]);
    }
}
