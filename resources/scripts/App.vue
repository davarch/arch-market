<template>
    <component :is="layout">
        <slot />
    </component>
</template>

<script lang="ts">
    import GuestLayout from '@/views/Layouts/GuestLayout.vue'
    import { defineComponent } from 'vue'

    export default defineComponent({
        name: 'App',

        data: () => ({
            layout: GuestLayout
        }),

        watch: {
            $route: {
                immediate: true,
                async handler(route) {
                    try {
                        const component = await import(
                            `./views/Layouts/${route.meta.layout}.vue`
                        )
                        this.layout = component?.default || GuestLayout
                    } catch (e) {
                        this.layout = GuestLayout
                    }
                }
            }
        }
    })
</script>
