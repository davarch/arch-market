<script lang="ts">
    import { defineComponent } from 'vue'
    import IconDelivery from '@/components/Icons/IconDelivery.vue'
    import IconShopping from '@/components/Icons/IconShopping.vue'
    import IconClient from '@/components/Icons/IconClient.vue'
    import IconSupport from '@/components/Icons/IconSupport.vue'
    import AdvantagesItem from '@/views/Home/Advantages/AdvantagesItem.vue'

    export default defineComponent({
        name: 'AdvantagesList',
        components: {
            AdvantagesItem,
            IconSupport,
            IconClient,
            IconShopping,
            IconDelivery
        }
    })
</script>

<template>
    <div
        class="grid grid-cols-1 sm:grid-cols-2 2xl:grid-cols-4 gap-3 sm:gap-4 md:gap-6 mt-8"
    >
        <advantages-item title="Бесплатная доставка" sub-title="от 1000 рублей">
            <icon-delivery />
        </advantages-item>

        <advantages-item title="Безопасный шопинг" sub-title="100% гарантии">
            <icon-shopping />
        </advantages-item>

        <advantages-item
            title="Работаем для клиента"
            sub-title="100% положительных отзывов"
        >
            <icon-client />
        </advantages-item>

        <advantages-item title="Поддержка" sub-title="онлайн чат 24/7">
            <icon-support />
        </advantages-item>
    </div>
</template>
