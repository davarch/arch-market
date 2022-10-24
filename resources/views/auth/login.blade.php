<x-guest-layout>
    <x-auth-card title="Вход в аккаунт">
        <form class="space-y-3" method="POST" action="{{ route('login') }}">
            @csrf

            <x-text-input
                name="email"
                type="email"
                placeholder="E-mail"
                required
                value="{{ old('email') }}"
                :is-error="$errors->has('email')"
            />
            <x-input-error :messages="$errors->get('email')"/>

            <x-text-input
                name="password"
                type="password"
                placeholder="Пароль"
                required
                :is-error="$errors->has('password')"
            />
            <x-input-error :messages="$errors->get('password')"/>

            <x-primary-button>Войти</x-primary-button>
            <x-github-button/>
        </form>

        <div class="space-y-3 mt-5">
            <div class="text-xxs md:text-xs"><a href="{{ route('password.request') }}" class="text-white hover:text-white/70 font-bold">Забыли пароль?</a></div>
            <div class="text-xxs md:text-xs"><a href="{{ route('register') }}" class="text-white hover:text-white/70 font-bold">Регистрация</a></div>
        </div>
    </x-auth-card>
</x-guest-layout>
