<script>
    import { defineComponent } from 'vue'

    export default defineComponent({
        name: 'GuestLayout'
    })
</script>

<template>
    <main
        class="md:min-h-screen md:flex md:items-center md:justify-center py-16 lg:py-20"
    >
        <router-view />
    </main>
</template>
