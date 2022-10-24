<x-guest-layout>
    <x-auth-card title="Смена пароля">
        <form class="space-y-3" method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">
            <x-text-input
                type="email"
                name="email"
                :value="old('email', $request->email)"
                required
                autofocus
                :is-error="$errors->has('email')"
            />
            <x-input-error :messages="$errors->get('email')"/>

            <x-text-input
                type="password"
                name="password"
                required
                placeholder="Новый пароль"
                :is-error="$errors->has('password')"
            />
            <x-input-error :messages="$errors->get('password')"/>

            <x-text-input
                type="password"
                name="password_confirmation"
                required
                placeholder="Повторно пароль"
                :is-error="$errors->has('password_confirmation')"
            />
            <x-input-error :messages="$errors->get('password_confirmation')"/>

            <x-primary-button>Восстановить пароль</x-primary-button>
        </form>
    </x-auth-card>
</x-guest-layout>
