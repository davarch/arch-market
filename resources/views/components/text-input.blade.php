@props([
    'disabled' => false,
    'isError' => false
])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->class([
    '_is-error' => $isError,
    'w-full h-14 px-4 rounded-lg border border-[#A07BF0] bg-white/20 outline-none transition text-white placeholder:text-white text-xxs md:text-xs font-semibold'
    ]) !!}/>
