<script lang="ts">
    import { defineComponent } from 'vue'
    import NavigationHeader from '@/components/Header/NavigationHeader.vue'
    import NavigationFooter from '@/components/Footer/NavigationFooter.vue'

    export default defineComponent({
        name: 'AppLayout',
        components: { NavigationFooter, NavigationHeader }
    })
</script>

<template>
    <navigation-header />

    <main class="py-16 lg:py-20">
        <router-view />
    </main>

    <navigation-footer />
</template>
