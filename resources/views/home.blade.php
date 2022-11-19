<x-app-layout>
    <main class="py-16 lg:py-20">
        <div class="container">
            <x-advantages/>
            <x-categories :categories="$categories"/>
            <x-products :products="$products"/>
            <x-brands :brands="$brands"/>
        </div>
    </main>
</x-app-layout>
