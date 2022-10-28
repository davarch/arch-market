<nav class="hidden 2xl:flex gap-8">
    @foreach($menu as $item)
        <a href="{{ $item['url'] }}" class="text-white hover:text-pink font-bold">{{ $item['name'] }}</a>
    @endforeach
</nav>
