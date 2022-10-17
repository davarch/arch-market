<script lang="ts">
    import { defineComponent } from 'vue'
    import BrandsListItem from '@/views/Home/Brands/BrandsListItem.vue'

    export default defineComponent({
        name: 'BrandList',

        components: { BrandsListItem },

        setup() {
            const brands = [
                {
                    link: 'catalog.html',
                    image: '1.png',
                    name: 'Steelseries'
                },
                {
                    link: 'catalog.html',
                    image: '2.png',
                    name: 'Razer'
                },
                {
                    link: 'catalog.html',
                    image: '3.png',
                    name: 'Logitech'
                },
                {
                    link: 'catalog.html',
                    image: '4.png',
                    name: 'HyperX'
                },
                {
                    link: 'catalog.html',
                    image: '5.png',
                    name: 'Playstation'
                },
                {
                    link: 'catalog.html',
                    image: '6.png',
                    name: 'XBOX'
                }
            ]

            return { brands }
        }
    })
</script>

<template>
    <div
        class="grid grid-cols-2 md:grid-cols-3 2xl:grid-cols-6 gap-4 md:gap-8 mt-12"
    >
        <brands-list-item
            v-for="(brand, key) in brands"
            :key="key"
            :link="brand.link"
            :image="brand.image"
        >
            {{ brand.name }}
        </brands-list-item>
    </div>
</template>
