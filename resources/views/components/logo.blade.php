
@props([
    'imageClass' => 'w-[120px] xs:w-[148px] md:w-[201px] h-[30px] xs:h-[36px] md:h-[50px]',
])

<a href="{{ route('home') }}" {{ $attributes->class('') }} rel="home">
    <img src="{{ Vite::image('logo.svg') }}" class="{{ $imageClass }}" alt="CutCode">
</a>
