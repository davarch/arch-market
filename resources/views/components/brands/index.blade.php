<x-section class="mt-20" title="Бренды">
    <div class="grid grid-cols-2 md:grid-cols-3 2xl:grid-cols-6 gap-4 md:gap-8 mt-12">
        @foreach($brands as $brand)
            <x-brands.item :title="$brand['title']" :slug="$brand['slug']" :thumbnail="$brand['thumbnail']"/>
        @endforeach
    </div>
</x-section>
