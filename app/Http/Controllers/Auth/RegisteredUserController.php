<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Providers\RouteServiceProvider;
use Domain\Auth\Contracts\RegisterUserContract;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return View
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  RegisterRequest  $request
     * @param  RegisterUserContract  $action
     * @return RedirectResponse
     */
    public function store(RegisterRequest $request, RegisterUserContract $action): RedirectResponse
    {
        $action($request->validated());

        return redirect(RouteServiceProvider::HOME);
    }
}
