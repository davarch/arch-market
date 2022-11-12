<footer class="footer py-8 sm:py-12 xl:py-16">
    <div class="container">
        <div class="flex flex-wrap lg:flex-nowrap items-center">
            <div class="footer-logo order-0 basis-full sm:basis-1/2 lg:basis-1/3 shrink-0 text-center sm:text-left">
                <x-logo class="inline-block" image-class="w-[155px] h-[38px]"/>
            </div>

            <div class="footer-copyright order-2 lg:order-1 basis-full lg:basis-1/3 mt-8 lg:mt-0">
                <div class="text-[#999] text-xxs xs:text-xs sm:text-sm text-center">
                    CutCode, {{ now()->year }} © Все права защищены.
                </div>
            </div>

            <div class="footer-social order-1 lg:order-2 basis-full sm:basis-1/2 lg:basis-1/3 mt-8 sm:mt-0">
                <div class="flex flex-wrap items-center justify-center sm:justify-end space-x-6">
                    <x-social-link image="icons/youtube.svg" name="YouTube" link="#"/>
                    <x-social-link image="icons/telegram.svg" name="Telegram" link="#"/>
                </div>
            </div>
        </div>
    </div>
</footer>
