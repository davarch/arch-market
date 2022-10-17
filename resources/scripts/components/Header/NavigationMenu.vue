<template>
    <nav class="hidden 2xl:flex gap-8">
        <navigation-menu-item
            v-for="(item, key) in menu"
            :key="key"
            :link="item.link"
        >
            {{ item.name }}
        </navigation-menu-item>
    </nav>
</template>

<script>
    import NavigationMenuItem from '@/components/Header/NavigationMenuItem.vue'

    export default {
        name: 'NavigationMenu',

        components: { NavigationMenuItem },

        setup() {
            const menu = [
                { link: 'index.html', name: 'Главная' },
                { link: 'catalog.html', name: 'Каталог товаров' },
                { link: 'cart.html', name: 'Корзина' }
            ]

            return { menu }
        }
    }
</script>
