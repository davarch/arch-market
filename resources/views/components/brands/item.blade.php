<a href="{{ $slug }}" class="p-6 rounded-xl bg-card hover:bg-card/60">
    <div class="h-12 md:h-16">
        <img src="{{ asset($thumbnail) }}" class="object-contain w-full h-full" alt="{{ $title }}">
    </div>
    <div class="mt-8 text-xs sm:text-sm lg:text-md font-semibold text-center">{{ $title }}</div>
</a>
