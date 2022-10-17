<template>
    <div
        class="footer-copyright order-2 lg:order-1 basis-full lg:basis-1/3 mt-8 lg:mt-0"
    >
        <div class="text-[#999] text-xxs xs:text-xs sm:text-sm text-center">
            <slot />
        </div>
    </div>
</template>

<script>
    export default {
        name: 'FooterCopyright'
    }
</script>
