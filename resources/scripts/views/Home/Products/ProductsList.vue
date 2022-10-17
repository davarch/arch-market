<script lang="ts">
    import { defineComponent } from 'vue'

    export default defineComponent({
        name: 'ProductsList'
    })
</script>

<template>
    <div
        class="products grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-x-8 gap-y-8 lg:gap-y-10 2xl:gap-y-12 mt-8"
    ></div>

    <div class="mt-12 text-center">
        <a href="catalog.html" class="btn btn-purple"> Все товары &nbsp;→ </a>
    </div>
</template>
