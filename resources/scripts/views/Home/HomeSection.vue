<script lang="ts">
    import { defineComponent } from 'vue'

    export default defineComponent({
        name: 'HomeSection',

        props: {
            title: {
                type: String,
                required: true
            }
        }
    })
</script>

<template>
    <section>
        <h2 class="text-lg lg:text-[42px] font-black">{{ title }}</h2>
        <slot />
    </section>
</template>
