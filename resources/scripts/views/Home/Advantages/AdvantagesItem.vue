<script lang="ts">
    import { defineComponent } from 'vue'

    export default defineComponent({
        name: 'AdvantagesItem',

        props: {
            title: {
                type: String,
                required: true
            },
            subTitle: {
                type: String,
                required: true
            }
        }
    })
</script>

<template>
    <div
        class="flex flex-col items-center gap-2 py-6 md:py-8 px-4 md:px-6 rounded-xl bg-purple text-white text-center"
    >
        <slot />
        <h5 class="pt-2 md:pt-4 text-sm md:text-md font-bold">
            {{ title }}
        </h5>
        <div class="text-xs md:text-sm">{{ subTitle }}</div>
    </div>
</template>
