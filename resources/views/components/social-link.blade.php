<a href="{{ $link }}" {{ $attributes->class('inline-flex items-center text-white hover:text-pink') }} target="_blank"
   rel="nofollow noopener">
    <img class="h-5 lg:h-6" src="{{ Vite::image($image) }}" alt="{{ $name }}">
    <span class="ml-2 lg:ml-3 text-xxs font-semibold">{{ $name }}</span>
</a>
