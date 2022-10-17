<script lang="ts">
    import { defineComponent } from 'vue'

    export default defineComponent({
        name: 'BrandsListItem',
        props: {
            link: {
                type: String,
                required: true
            },

            image: {
                type: String,
                required: true
            }
        },

        setup() {
            const getSrc = (name: string) => {
                const path = `/resources/images/brands/${name}`
                const modules = import.meta.glob(
                    ['/resources/images/brands/*.png'],
                    { eager: true }
                )
                return modules[path].default
            }

            return { getSrc }
        }
    })
</script>

<template>
    <a :href="link" class="p-6 rounded-xl bg-card hover:bg-card/60">
        <div class="h-12 md:h-16">
            <img
                :src="getSrc(image)"
                class="object-contain w-full h-full"
                alt=""
            />
        </div>
        <div
            class="mt-8 text-xs sm:text-sm lg:text-md font-semibold text-center"
        >
            <slot />
        </div>
    </a>
</template>
