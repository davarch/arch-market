<template>
    <a :href="link" class="text-white hover:text-pink font-bold">
        <slot />
    </a>
</template>

<script>
    export default {
        name: 'NavigationMenuItem',
        props: {
            link: {
                type: String,
                required: true
            }
        }
    }
</script>
