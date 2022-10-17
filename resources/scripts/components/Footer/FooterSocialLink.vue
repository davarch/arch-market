<template>
    <a
        :href="link"
        class="inline-flex items-center text-white hover:text-pink"
        target="_blank"
        rel="nofollow noopener"
    >
        <img class="h-5 lg:h-6" :src="getSrc(image)" :alt="alt" />
        <span class="ml-2 lg:ml-3 text-xxs font-semibold">
            <slot />
        </span>
    </a>
</template>

<script lang="ts">
    import { defineComponent } from 'vue'

    export default defineComponent({
        name: 'FooterSocialLink',

        props: {
            link: {
                type: String,
                required: true
            },

            image: {
                type: String,
                required: true
            },

            alt: {
                type: String,
                required: true
            }
        },

        setup() {
            const getSrc = (name: string) => {
                const path = `/resources/images/icons/${name}`
                const modules = import.meta.glob(
                    ['/resources/images/icons/*.svg'],
                    { eager: true }
                )
                return modules[path].default
            }

            return { getSrc }
        }
    })
</script>
