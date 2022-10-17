<script>
    import CategoriesLink from '@/views/Home/Categories/CategoriesLink.vue'
    import { defineComponent } from 'vue'

    export default defineComponent({
        name: 'CategoriesList',

        components: { CategoriesLink },

        setup() {
            const categories = [
                { link: 'catalog.html', name: 'Мыши' },
                { link: 'catalog.html', name: 'Клавиатуры' },
                { link: 'catalog.html', name: 'Наушники' },
                { link: 'catalog.html', name: 'Поверхности' },
                { link: 'catalog.html', name: 'Мониторы' },
                { link: 'catalog.html', name: 'Геймпады' },
                { link: 'catalog.html', name: 'Консоли' },
                { link: 'catalog.html', name: 'Акустика' },
                { link: 'catalog.html', name: 'Аксессуары' },
                { link: 'catalog.html', name: 'Распродажа' }
            ]

            return { categories }
        }
    })
</script>

<template>
    <div
        class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-5 gap-3 sm:gap-4 md:gap-5 mt-8"
    >
        <categories-link
            v-for="(category, key) in categories"
            :key="key"
            :link="category.link"
            >{{ category.name }}</categories-link
        >
    </div>
</template>
