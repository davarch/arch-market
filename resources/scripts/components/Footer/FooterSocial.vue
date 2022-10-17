<template>
    <div
        class="footer-social order-1 lg:order-2 basis-full sm:basis-1/2 lg:basis-1/3 mt-8 sm:mt-0"
    >
        <div
            class="flex flex-wrap items-center justify-center sm:justify-end space-x-6"
        >
            <footer-social-link
                v-for="(social, key) in socials"
                :key="key"
                :link="social.link"
                :image="social.image"
                :alt="social.alt"
            >
                {{ social.name }}
            </footer-social-link>
        </div>
    </div>
</template>

<script>
    import FooterSocialLink from './FooterSocialLink.vue'
    export default {
        name: 'FooterSocial',
        components: { FooterSocialLink },
        setup() {
            const socials = [
                {
                    link: '#',
                    image: 'youtube.svg',
                    name: 'YouTube',
                    alt: 'YouTube'
                },
                {
                    link: '#',
                    image: 'telegram.svg',
                    name: 'Telegram',
                    alt: 'Telegram'
                }
            ]

            return { socials }
        }
    }
</script>

<style scoped></style>
