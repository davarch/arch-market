<template>
    <a
        :href="link"
        class="p-3 sm:p-4 2xl:p-6 rounded-xl bg-card hover:bg-pink text-xxs sm:text-xs lg:text-sm text-white font-semibold"
    >
        <slot />
    </a>
</template>

<script lang="ts">
    import { defineComponent } from 'vue'

    export default defineComponent({
        name: 'CategoriesLink',

        props: {
            link: {
                type: String,
                required: true
            }
        }
    })
</script>
