<button {{ $attributes->merge(['type' => 'submit', 'class' => 'w-full btn btn-pink']) }}>
    {{ $slot }}
</button>
