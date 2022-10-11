<x-guest-layout>
    <x-auth-card title="Восстановить пароль">
        <form class="space-y-3" method="post" action="{{ route('password.email') }}">
            @csrf
            <x-text-input name="email" type="email" placeholder="E-mail" required/>
            <x-input-error :messages="$errors->get('email')"/>
            <x-primary-button>Отправить</x-primary-button>
        </form>

        <div class="space-y-3 mt-5">
            <div class="text-xxs md:text-xs"><a href="{{ route('register') }}" class="text-white hover:text-white/70 font-bold">Регистрация</a></div>
        </div>
    </x-auth-card>
</x-guest-layout>
