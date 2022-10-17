<script lang="ts">
    import { defineComponent } from 'vue'
    import AdvantagesList from '@/views/Home/Advantages/AdvantagesList.vue'
    import CategoriesList from '@/views/Home/Categories/CategoriesList.vue'
    import ProductsList from '@/views/Home/Products/ProductsList.vue'
    import BrandList from '@/views/Home/Brands/BrandList.vue'
    import HomeSection from '@/views/Home/HomeSection.vue'
    import UiContainer from '@/components/UiContainer.vue'

    export default defineComponent({
        name: 'HomeIndex',

        components: {
            UiContainer,
            HomeSection,
            BrandList,
            ProductsList,
            CategoriesList,
            AdvantagesList
        }
    })
</script>

<template>
    <ui-container>
        <home-section title="Наши преимущества">
            <advantages-list />
        </home-section>

        <home-section title="Категории" class="mt-16 lg:mt-24">
            <categories-list />
        </home-section>

        <home-section title="Каталог товаров" class="mt-16 lg:mt-24">
            <products-list />
        </home-section>

        <home-section title="Бренды" class="mt-20">
            <brand-list />
        </home-section>
    </ui-container>
</template>
