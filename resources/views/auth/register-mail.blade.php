<x-guest-layout>
    <x-auth-card title="Регистрация">
        <form class="space-y-3" method="POST" action="{{ route('register') }}">
            @csrf

            <x-text-input name="name" type="text" placeholder="Имя и фамилия" required/>
            <x-input-error :messages="$errors->get('name')"/>

            <x-text-input name="email" type="email" placeholder="E-mail" required/>
            <x-input-error :messages="$errors->get('email')"/>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <x-text-input name="password" type="password" placeholder="Пароль" required class="@error focus:border-pink focus:shadow-[0_0_0_2px_#EC4176] @enderror"/>
                    <x-input-error :messages="$errors->get('password')"/>
                </div>

                <div>
                    <x-text-input name="password_confirmation" type="password" placeholder="Повторно пароль" required/>
                    <x-input-error :messages="$errors->get('password_confirmation')"/>
                </div>
            </div>
            <x-primary-button>Зарегистрироваться</x-primary-button>
        </form>

        <div class="space-y-3 mt-5">
            <div class="text-xxs md:text-xs">Есть аккаунт?
                <a href=" {{ route('login') }} "
                   class="text-white hover:text-white/70 font-bold underline underline-offset-4">Войти</a>
            </div>
        </div>
    </x-auth-card>
</x-guest-layout>
