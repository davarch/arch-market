@props([
    'title' => ''
])

<section {{ $attributes }}>
    <h2 class="text-lg lg:text-[42px] font-black">{{ $title }}</h2>

    {{ $slot }}
</section>
