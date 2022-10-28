<x-guest-layout>
    <x-auth-card title="Регистрация">
        <form class="space-y-3" method="POST" action="{{ route('register') }}">
            @csrf

            <x-text-input
                name="name"
                type="text"
                placeholder="Имя и фамилия"
                required
                value="{{ old('name') }}"
                :is-error="$errors->has('name')"
            />
            <x-input-error :messages="$errors->get('name')"/>

            <x-text-input
                name="email"
                type="email"
                placeholder="E-mail"
                required
                value="{{ old('email') }}"
                :is-error="$errors->has('email')"
            />
            <x-input-error :messages="$errors->get('email')"/>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <x-text-input
                        name="password"
                        type="password"
                        placeholder="Пароль"
                        required
                        :is-error="$errors->has('password')"
                    />
                    <x-input-error :messages="$errors->get('password')"/>
                </div>

                <div>
                    <x-text-input
                        name="password_confirmation"
                        type="password"
                        placeholder="Повторно пароль"
                        required
                        :is-error="$errors->has('password_confirmation')"
                    />
                    <x-input-error :messages="$errors->get('password_confirmation')"/>
                </div>
            </div>

            <x-primary-button>Зарегистрироваться</x-primary-button>
            <x-github-button/>
        </form>

        <div class="space-y-3 mt-5">
            <div class="text-xxs md:text-xs">Есть аккаунт?
                <a href=" {{ route('login') }} "
                   class="text-white hover:text-white/70 font-bold underline underline-offset-4">Войти</a>
            </div>
        </div>
    </x-auth-card>
</x-guest-layout>
