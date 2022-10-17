<template>
    <button
        id="burgerMenu"
        class="flex 2xl:hidden text-white hover:text-pink transition"
    >
        <span class="sr-only">Меню</span>
        <icon-burger />
    </button>
</template>

<script>
    import IconBurger from '@/components/Icons/IconBurger.vue'
    export default {
        name: 'BurgerMenu',
        components: { IconBurger }
    }
</script>
