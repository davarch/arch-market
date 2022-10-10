@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'mt-3 text-pink text-xxs xs:text-xs']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
