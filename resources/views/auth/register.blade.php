<x-guest-layout>
    <x-auth-card title="Регистрация">
        <x-auth-preview :link="route('register-mail')"/>

        <div class="space-y-3 mt-5">
            <div class="text-xxs md:text-xs">Есть аккаунт?
                <a href=" {{ route('login') }} "
                   class="text-white hover:text-white/70 font-bold underline underline-offset-4">Войти</a>
            </div>
        </div>
    </x-auth-card>
</x-guest-layout>
