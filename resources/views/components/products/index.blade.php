<x-section class="mt-16 lg:mt-24" title="Каталог товаров">
    <div
        class="products grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-x-8 gap-y-8 lg:gap-y-10 2xl:gap-y-12 mt-8"
    >
        @foreach($products as $product)
            <x-products.item :title="$product['title']" :slug="$product['slug']" :thumbnail="$product->makeThumbnail('345x320')" :price="$product['price']"/>
        @endforeach
    </div>

    <div class="mt-12 text-center">
        <a href="/catalogue" class="btn btn-purple">Все товары &nbsp;→</a>
    </div>
</x-section>
