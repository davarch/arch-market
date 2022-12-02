<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use Domain\Auth\Contracts\RegisterUserContract;
use Domain\Auth\DTO\RegisterUserDTO;
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
        auth()->login(
            $action(RegisterUserDTO::from($request->validated()))
        );

        return redirect(route('home'));
    }
}
