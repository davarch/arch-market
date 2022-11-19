@props(['categories'])

<x-section class="mt-16 lg:mt-24" title="Категории">
    <div class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-5 gap-3 sm:gap-4 md:gap-5 mt-8">
        @foreach($categories as $category)
            <x-categories.item :title="$category['title']" :slug="$category['slug']"/>
        @endforeach
    </div>
</x-section>
