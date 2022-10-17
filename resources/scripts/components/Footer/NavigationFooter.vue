<template>
    <footer class="footer py-8 sm:py-12 xl:py-16">
        <div class="container">
            <div class="flex flex-wrap lg:flex-nowrap items-center">
                <footer-logo />

                <footer-copyright>
                    CutCode, 2021 © Все права защищены.
                </footer-copyright>

                <footer-social />
            </div>
        </div>
    </footer>
</template>

<script>
    import FooterCopyright from '@/components/Footer/FooterCopyright.vue'
    import FooterSocial from '@/components/Footer/FooterSocial.vue'
    import FooterLogo from '@/components/Footer/FooterLogo.vue'

    export default {
        name: 'NavigationFooter',

        components: { FooterLogo, FooterSocial, FooterCopyright }
    }
</script>
