<x-guest-layout>
    <x-auth-card title="Вход в аккаунт">
        <x-auth-preview :link="route('login-mail')"/>

        <div class="space-y-3 mt-5">
            <div class="text-xxs md:text-xs">
                <a href="{{ route('register') }}" class="text-white hover:text-white/70 font-bold">Регистрация</a>
            </div>
        </div>
    </x-auth-card>
</x-guest-layout>
