<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">

    <title>Arch Market</title>

    @vite('resources/js/app.js')
</head>

<body x-data="{ 'showTaskUploadModal': false, 'showTaskEditModal': false }" x-cloak>
<header class="header pt-6 xl:pt-12">
    <div class="container">
        <div class="header-inner flex items-center justify-between lg:justify-start">
            <div class="header-logo shrink-0">
                <a href="index.html" rel="home">
                    <img src="{{ Vite::image('logo.svg') }}"
                         class="w-[120px] xs:w-[148px] md:w-[201px] h-[30px] xs:h-[36px] md:h-[50px]" alt="CutCode">
                </a>
            </div><!-- /.header-logo -->
            <div class="header-menu grow hidden lg:flex items-center ml-8 mr-8 gap-8">
                <form class="hidden lg:flex gap-3">
                    <input type="search"
                           class="w-full h-12 px-4 rounded-lg border border-body/10 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xs shadow-transparent outline-0 transition"
                           placeholder="Поиск..." required>
                    <button type="submit" class="shrink-0 w-12 !h-12 !px-0 btn btn-pink">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 52 52">
                            <path
                                d="M50.339 47.364 37.963 34.492a20.927 20.927 0 0 0 4.925-13.497C42.888 9.419 33.47 0 21.893 0 10.317 0 .898 9.419.898 20.995S10.317 41.99 21.893 41.99a20.77 20.77 0 0 0 12.029-3.8l12.47 12.97c.521.542 1.222.84 1.973.84.711 0 1.386-.271 1.898-.764a2.742 2.742 0 0 0 .076-3.872ZM21.893 5.477c8.557 0 15.518 6.961 15.518 15.518s-6.96 15.518-15.518 15.518c-8.556 0-15.518-6.961-15.518-15.518S13.337 5.477 21.893 5.477Z"/>
                        </svg>
                    </button>
                </form>
                <nav class="hidden 2xl:flex gap-8">
                    <a href="index.html" class="text-white hover:text-pink font-bold">Главная</a>
                    <a href="catalog.html" class="text-white hover:text-pink font-bold">Каталог товаров</a>
                    <a href="cart.html" class="text-white hover:text-pink font-bold">Корзина</a>
                </nav>
            </div><!-- /.header-menu -->
            <div class="header-actions flex items-center gap-3 md:gap-5">
                <!-- <a href="login.html" class="profile hidden xs:flex items-center">
                    <svg class="profile-icon w-8 h-8 text-purple" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 32 32"><defs/><path d="M26.749 24.93A13.99 13.99 0 1 0 2 16a13.899 13.899 0 0 0 3.251 8.93l-.02.017c.07.084.15.156.222.239c.09.103.187.2.28.3c.28.304.568.596.87.87c.092.084.187.162.28.242c.32.276.649.538.99.782c.044.03.084.069.128.1v-.012a13.901 13.901 0 0 0 16 0v.012c.044-.031.083-.07.128-.1c.34-.245.67-.506.99-.782c.093-.08.188-.159.28-.242c.302-.275.59-.566.87-.87c.093-.1.189-.197.28-.3c.071-.083.152-.155.222-.24zM16 8a4.5 4.5 0 1 1-4.5 4.5A4.5 4.5 0 0 1 16 8zM8.007 24.93A4.996 4.996 0 0 1 13 20h6a4.996 4.996 0 0 1 4.993 4.93a11.94 11.94 0 0 1-15.986 0z" fill="currentColor"/></svg>
                    <span class="profile-text relative ml-2 text-white text-xxs md:text-xs font-bold">Войти</span>
                </a> -->
                <div x-data="{dropdownProfile: false}" class="profile relative">
                    <button @click="dropdownProfile = ! dropdownProfile"
                            class="flex items-center text-white hover:text-pink transition">
                        <span class="sr-only">Профиль</span>
                        <img src="{{ Vite::image('avatar.jpg') }}" class="shrink-0 w-7 md:w-9 h-7 md:h-9 rounded-full"
                             alt="Данил Шуцкий">
                        <span class="hidden md:block ml-2 font-medium">Данил</span>
                        <svg class="shrink-0 w-3 h-3 ml-2" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                             viewBox="0 0 30 16">
                            <path fill-rule="evenodd"
                                  d="M27.536.72a2 2 0 0 1-.256 2.816l-12 10a2 2 0 0 1-2.56 0l-12-10A2 2 0 1 1 3.28.464L14 9.397 24.72.464a2 2 0 0 1 2.816.256Z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </button>
                    <div
                        x-show="dropdownProfile"
                        @click.away="dropdownProfile = false"
                        x-transition:enter="ease-out duration-300"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        x-transition:leave="ease-in duration-150"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        class="absolute z-50 top-0 -right-20 xs:-right-8 sm:right-0 w-[280px] sm:w-[300px] mt-14 p-4 rounded-lg shadow-xl bg-card"
                    >
                        <h5 class="text-body text-xs">Мой профиль</h5>
                        <div class="flex items-center mt-3">
                            <img src="{{ Vite::image('avatar.jpg') }}" class="w-11 h-11 rounded-full"
                                 alt="Данил Шуцкий">
                            <span class="ml-3 text-xs md:text-sm font-bold">Данил Шуцкий</span>
                        </div>
                        <div class="mt-4">
                            <ul class="space-y-2">
                                <li><a href="orders.html" class="text-body hover:text-white text-xs font-medium">Мои
                                        заказы</a></li>
                                <li><a href="edit-profile.html" class="text-body hover:text-white text-xs font-medium">Редактировать
                                        профиль</a></li>
                            </ul>
                        </div>
                        <div class="mt-6">
                            <a href="#" class="inline-flex items-center text-body hover:text-pink">
                                <svg class="shrink-0 w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                     viewBox="0 0 20 20">
                                    <path
                                        d="m19.026 7.643-3.233-3.232a.833.833 0 0 0-1.178 1.178l3.232 3.233c.097.098.18.207.25.325-.012 0-.022-.007-.035-.007l-13.07.027a.833.833 0 1 0 0 1.666l13.066-.026c.023 0 .042-.012.064-.014a1.621 1.621 0 0 1-.278.385l-3.232 3.233a.833.833 0 1 0 1.178 1.178l3.233-3.232a3.333 3.333 0 0 0 0-4.714h.003Z"/>
                                    <path
                                        d="M5.835 18.333H4.17a2.5 2.5 0 0 1-2.5-2.5V4.167a2.5 2.5 0 0 1 2.5-2.5h1.666a.833.833 0 1 0 0-1.667H4.17A4.172 4.172 0 0 0 .002 4.167v11.666A4.172 4.172 0 0 0 4.169 20h1.666a.833.833 0 1 0 0-1.667Z"/>
                                </svg>
                                <span class="ml-2 font-medium">Выйти</span>
                            </a>
                        </div>
                    </div>
                </div>
                <a href="cart.html" class="flex items-center gap-3 text-pink hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 md:w-7 w-6 md:h-7" fill="currentColor"
                         viewBox="0 0 52 52">
                        <path
                            d="M26 0a10.4 10.4 0 0 0-10.4 10.4v1.733h-1.439a5.668 5.668 0 0 0-5.668 5.408L7.124 46.055A5.685 5.685 0 0 0 12.792 52h26.416a5.686 5.686 0 0 0 5.668-5.945l-1.37-28.514a5.668 5.668 0 0 0-5.667-5.408H36.4V10.4A10.4 10.4 0 0 0 26 0Zm-6.933 10.4a6.934 6.934 0 0 1 13.866 0v1.733H19.067V10.4Zm-2.843 8.996a1.734 1.734 0 1 1 3.468 0 1.734 1.734 0 0 1-3.468 0Zm16.085 0a1.733 1.733 0 1 1 3.467 0 1.733 1.733 0 0 1-3.467 0Z"/>
                    </svg>
                    <div class="hidden sm:flex flex-col gap-2">
                        <span class="text-body text-xxs leading-none">3 шт.</span>
                        <span class="text-white text-xxs 2xl:text-xs font-bold !leading-none">57 900 ₽</span>
                    </div>
                </a>
                <button id="burgerMenu" class="flex 2xl:hidden text-white hover:text-pink transition">
                    <span class="sr-only">Меню</span>
                    <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div><!-- /.header-actions -->
        </div><!-- /.header-inner -->
    </div><!-- /.container -->
</header>
<main class="py-16 lg:py-20">
    <div class="container">

        <section>
            <!-- Section heading -->
            <h2 class="text-lg lg:text-[42px] font-black">Наши преимущества</h2>

            <!-- Advantages -->
            <div class="grid grid-cols-1 sm:grid-cols-2 2xl:grid-cols-4 gap-3 sm:gap-4 md:gap-6 mt-8">
                <div
                    class="flex flex-col items-center gap-2 py-6 md:py-8 px-4 md:px-6 rounded-xl bg-purple text-white text-center">
                    <svg class="w-10 md:w-12 h-10 md:h-12 opacity-40" xmlns="http://www.w3.org/2000/svg"
                         fill="currentColor" viewBox="0 0 18 18">
                        <path fill-rule="evenodd"
                              d="M1.302 2.65H11.64c.292 0 .528.236.528.527v1.056h3.007c.33 0 .62.218.71.536l.905 3.166c.106.019.205.07.282.147l.747.746a.528.528 0 0 1 .154.373v3.476a.528.528 0 0 1-.527.528H15.86a2.111 2.111 0 0 1-4.222 0H6.361a2.111 2.111 0 0 1-4.222 0H.556a.528.528 0 0 1-.528-.528V3.924a.53.53 0 0 1 .155-.374l.746-.746a.528.528 0 0 1 .373-.155ZM15.69 7.926l-.754-2.639h-2.768V7.4c0 .292.236.528.528.528h2.994Zm-1.94 4.224a1.056 1.056 0 1 1 0 2.111 1.056 1.056 0 0 1 0-2.11ZM3.195 13.205a1.055 1.055 0 1 0 2.11 0 1.055 1.055 0 0 0-2.11 0Z"
                              clip-rule="evenodd"/>
                    </svg>
                    <h5 class="pt-2 md:pt-4 text-sm md:text-md font-bold">Бесплатная доставка</h5>
                    <div class="text-xs md:text-sm">от 1000 рублей</div>
                </div>
                <div
                    class="flex flex-col items-center gap-2 py-6 md:py-8 px-4 md:px-6 rounded-xl bg-purple text-white text-center">
                    <svg class="w-10 md:w-12 h-10 md:h-12 opacity-40" xmlns="http://www.w3.org/2000/svg"
                         fill="currentColor" viewBox="0 0 18 18">
                        <path
                            d="M9 0a3.6 3.6 0 0 0-3.6 3.6v.6h-.498A1.962 1.962 0 0 0 2.94 6.072l-.474 9.87A1.968 1.968 0 0 0 4.428 18h9.144a1.969 1.969 0 0 0 1.962-2.058l-.474-9.87A1.961 1.961 0 0 0 13.098 4.2H12.6v-.6A3.6 3.6 0 0 0 9 0ZM6.6 3.6a2.4 2.4 0 1 1 4.8 0v.6H6.6v-.6Zm-.984 3.114a.6.6 0 1 1 1.2 0 .6.6 0 0 1-1.2 0Zm5.568 0a.6.6 0 1 1 1.2 0 .6.6 0 0 1-1.2 0Z"/>
                    </svg>
                    <h5 class="pt-2 md:pt-4 text-sm md:text-md font-bold">Безопасный шопинг</h5>
                    <div class="text-xs md:text-sm">100% гарантии</div>
                </div>
                <div
                    class="flex flex-col items-center gap-2 py-6 md:py-8 px-4 md:px-6 rounded-xl bg-purple text-white text-center">
                    <svg class="w-10 md:w-12 h-10 md:h-12 opacity-40" xmlns="http://www.w3.org/2000/svg"
                         fill="currentColor" viewBox="0 0 18 18">
                        <path
                            d="M17.953 6.905a.955.955 0 0 0-.823-.658l-5.196-.471L9.88.967a.957.957 0 0 0-1.76.001L6.066 5.776.87 6.247a.957.957 0 0 0-.543 1.674l3.927 3.445-1.158 5.1A.956.956 0 0 0 4.519 17.5L9 14.822l4.48 2.678a.957.957 0 0 0 1.424-1.034l-1.159-5.1 3.928-3.444a.957.957 0 0 0 .28-1.017Z"/>
                    </svg>
                    <h5 class="pt-2 md:pt-4 text-sm md:text-md font-bold">Работаем для клиента</h5>
                    <div class="text-xs md:text-sm">100% положительных отзывов</div>
                </div>
                <div
                    class="flex flex-col items-center gap-2 py-6 md:py-8 px-4 md:px-6 rounded-xl bg-purple text-white text-center">
                    <svg class="w-10 md:w-12 h-10 md:h-12 opacity-40" xmlns="http://www.w3.org/2000/svg"
                         fill="currentColor" viewBox="0 0 18 18">
                        <path fill-rule="evenodd"
                              d="M0 2.572C0 1.507.863.643 1.929.643H16.07c1.067 0 1.93.864 1.93 1.929v10.285a1.928 1.928 0 0 1-1.929 1.929h-6.89l-4.023 2.476a.643.643 0 0 1-.98-.547v-1.93h-2.25A1.929 1.929 0 0 1 0 12.858V2.572Zm5.143 3.857a1.286 1.286 0 1 0 0 2.571 1.286 1.286 0 0 0 0-2.571Zm2.571 1.285a1.286 1.286 0 1 1 2.572 0 1.286 1.286 0 0 1-2.572 0Zm5.143-1.285a1.286 1.286 0 1 0 0 2.571 1.286 1.286 0 0 0 0-2.571Z"
                              clip-rule="evenodd"/>
                    </svg>
                    <h5 class="pt-2 md:pt-4 text-sm md:text-md font-bold">Поддержка</h5>
                    <div class="text-xs md:text-sm">онлайн чат 24/7</div>
                </div>
            </div>
        </section>

        <section class="mt-16 lg:mt-24">
            <!-- Section heading -->
            <h2 class="text-lg lg:text-[42px] font-black">Категории</h2>

            <!-- Categories -->
            <div class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-5 gap-3 sm:gap-4 md:gap-5 mt-8">
                <a href="catalog.html"
                   class="p-3 sm:p-4 2xl:p-6 rounded-xl bg-card hover:bg-pink text-xxs sm:text-xs lg:text-sm text-white font-semibold">Мыши</a>
                <a href="catalog.html"
                   class="p-3 sm:p-4 2xl:p-6 rounded-xl bg-card hover:bg-pink text-xxs sm:text-xs lg:text-sm text-white font-semibold">Клавиатуры</a>
                <a href="catalog.html"
                   class="p-3 sm:p-4 2xl:p-6 rounded-xl bg-card hover:bg-pink text-xxs sm:text-xs lg:text-sm text-white font-semibold">Наушники</a>
                <a href="catalog.html"
                   class="p-3 sm:p-4 2xl:p-6 rounded-xl bg-card hover:bg-pink text-xxs sm:text-xs lg:text-sm text-white font-semibold">Поверхности</a>
                <a href="catalog.html"
                   class="p-3 sm:p-4 2xl:p-6 rounded-xl bg-card hover:bg-pink text-xxs sm:text-xs lg:text-sm text-white font-semibold">Мониторы</a>
                <a href="catalog.html"
                   class="p-3 sm:p-4 2xl:p-6 rounded-xl bg-card hover:bg-pink text-xxs sm:text-xs lg:text-sm text-white font-semibold">Геймпады</a>
                <a href="catalog.html"
                   class="p-3 sm:p-4 2xl:p-6 rounded-xl bg-card hover:bg-pink text-xxs sm:text-xs lg:text-sm text-white font-semibold">Консоли</a>
                <a href="catalog.html"
                   class="p-3 sm:p-4 2xl:p-6 rounded-xl bg-card hover:bg-pink text-xxs sm:text-xs lg:text-sm text-white font-semibold">Акустика</a>
                <a href="catalog.html"
                   class="p-3 sm:p-4 2xl:p-6 rounded-xl bg-card hover:bg-pink text-xxs sm:text-xs lg:text-sm text-white font-semibold">Аксесуары</a>
                <a href="catalog.html"
                   class="p-3 sm:p-4 2xl:p-6 rounded-xl bg-card hover:bg-pink text-xxs sm:text-xs lg:text-sm text-white font-semibold">Распродажа</a>
            </div>
        </section>

        <section class="mt-16 lg:mt-24">
            <!-- Section heading -->
            <h2 class="text-lg lg:text-[42px] font-black">Каталог товаров</h2>

            <!-- Products list -->
            <div
                class="products grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-x-8 gap-y-8 lg:gap-y-10 2xl:gap-y-12 mt-8">
            </div>

            <div class="mt-12 text-center">
                <a href="catalog.html" class="btn btn-purple">Все товары &nbsp;→</a>
            </div>
        </section>

        <section class="mt-20">
            <!-- Section heading -->
            <h2 class="text-lg lg:text-[42px] font-black">Бренды</h2>

            <!-- Brands list -->
            <div class="grid grid-cols-2 md:grid-cols-3 2xl:grid-cols-6 gap-4 md:gap-8 mt-12">
                <a href="catalog.html" class="p-6 rounded-xl bg-card hover:bg-card/60">
                    <div class="h-12 md:h-16">
                        <img src="{{ Vite::image('brands/1.png') }}" class="object-contain w-full h-full"
                             alt="Steelseries">
                    </div>
                    <div class="mt-8 text-xs sm:text-sm lg:text-md font-semibold text-center">Steelseries</div>
                </a>
                <a href="catalog.html" class="p-6 rounded-xl bg-card hover:bg-card/60">
                    <div class="h-12 md:h-16">
                        <img src="{{ Vite::image('brands/2.png') }}" class="object-contain w-full h-full" alt="Razer">
                    </div>
                    <div class="mt-8 text-xs sm:text-sm lg:text-md font-semibold text-center">Razer</div>
                </a>
                <a href="catalog.html" class="p-6 rounded-xl bg-card hover:bg-card/60">
                    <div class="h-12 md:h-16">
                        <img src="{{ Vite::image('brands/3.png') }}" class="object-contain w-full h-full"
                             alt="Logitech">
                    </div>
                    <div class="mt-8 text-xs sm:text-sm lg:text-md font-semibold text-center">Logitech</div>
                </a>
                <a href="catalog.html" class="p-6 rounded-xl bg-card hover:bg-card/60">
                    <div class="h-12 md:h-16">
                        <img src="{{ Vite::image('brands/4.png') }}" class="object-contain w-full h-full" alt="HyperX">
                    </div>
                    <div class="mt-8 text-xs sm:text-sm lg:text-md font-semibold text-center">HyperX</div>
                </a>
                <a href="catalog.html" class="p-6 rounded-xl bg-card hover:bg-card/60">
                    <div class="h-12 md:h-16">
                        <img src="{{ Vite::image('brands/5.png') }}" class="object-contain w-full h-full"
                             alt="Playstation">
                    </div>
                    <div class="mt-8 text-xs sm:text-sm lg:text-md font-semibold text-center">Playstation</div>
                </a>
                <a href="catalog.html" class="p-6 rounded-xl bg-card hover:bg-card/60">
                    <div class="h-12 md:h-16">
                        <img src="{{ Vite::image('brands/6.png') }}" class="object-contain w-full h-full" alt="XBOX">
                    </div>
                    <div class="mt-8 text-xs sm:text-sm lg:text-md font-semibold text-center">XBOX</div>
                </a>
            </div>
        </section>

    </div>
</main>
<footer class="footer py-8 sm:py-12 xl:py-16">
    <div class="container">
        <div class="flex flex-wrap lg:flex-nowrap items-center">
            <div class="footer-logo order-0 basis-full sm:basis-1/2 lg:basis-1/3 shrink-0 text-center sm:text-left">
                <a href="index.html" class="inline-block" rel="home">
                    <img src="{{ Vite::image('logo.svg') }}" class="w-[155px] h-[38px]" alt="CutCode">
                </a>
            </div><!-- /.footer-logo -->
            <div class="footer-copyright order-2 lg:order-1 basis-full lg:basis-1/3 mt-8 lg:mt-0">
                <div class="text-[#999] text-xxs xs:text-xs sm:text-sm text-center">CutCode, 2021 © Все права
                    защещены.
                </div>
            </div><!-- /.footer-copyright -->
            <div class="footer-social order-1 lg:order-2 basis-full sm:basis-1/2 lg:basis-1/3 mt-8 sm:mt-0">
                <div class="flex flex-wrap items-center justify-center sm:justify-end space-x-6">
                    <a href="#" class="inline-flex items-center text-white hover:text-pink" target="_blank"
                       rel="nofollow noopener">
                        <img class="h-5 lg:h-6" src="{{ Vite::image('icons/youtube.svg') }}" alt="YouTube">
                        <span class="ml-2 lg:ml-3 text-xxs font-semibold">YouTube</span>
                    </a>
                    <a href="#" class="inline-flex items-center text-white hover:text-pink" target="_blank"
                       rel="nofollow noopener">
                        <img class="h-5 lg:h-6" src="{{ Vite::image('icons/telegram.svg') }}" alt="Telegram">
                        <span class="ml-2 lg:ml-3 text-xxs font-semibold">Telegram</span>
                    </a>
                </div>
            </div><!-- /.footer-social -->
        </div>
    </div><!-- /.container -->
</footer>
</body>
</html>
