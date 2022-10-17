<template>
    <header class="header pt-6 xl:pt-12">
        <div class="container">
            <div
                class="header-inner flex items-center justify-between lg:justify-start"
            >
                <div class="header-logo shrink-0">
                    <a href="/public" rel="home">
                        <img
                            src="@~/images/logo.svg"
                            class="w-[120px] xs:w-[148px] md:w-[201px] h-[30px] xs:h-[36px] md:h-[50px]"
                            alt="CutCode"
                        />
                    </a>
                </div>
                <!-- /.header-logo -->
                <div
                    class="header-menu grow hidden lg:flex items-center ml-8 mr-8 gap-8"
                >
                    <form class="hidden lg:flex gap-3">
                        <input
                            type="search"
                            class="w-full h-12 px-4 rounded-lg border border-body/10 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xs shadow-transparent outline-0 transition"
                            placeholder="Поиск..."
                            required
                        />
                        <button
                            type="submit"
                            class="shrink-0 w-12 !h-12 !px-0 btn btn-pink"
                        >
                            <icon-search />
                        </button>
                    </form>
                    <navigation-menu />
                </div>
                <!-- /.header-menu -->
                <div class="header-actions flex items-center gap-3 md:gap-5">
                    <a
                        href="/login"
                        class="profile hidden xs:flex items-center"
                    >
                        <icon-profile />
                        <span
                            class="profile-text relative ml-2 text-white text-xxs md:text-xs font-bold"
                        >
                            Войти
                        </span>
                    </a>
                    <div v-if="false" class="profile relative">
                        <button
                            class="flex items-center text-white hover:text-pink transition"
                        >
                            <span class="sr-only">Профиль</span>
                            <img
                                src="@~/images/avatar.jpg"
                                class="shrink-0 w-7 md:w-9 h-7 md:h-9 rounded-full"
                                alt="Данил Шуцкий"
                            />
                            <span class="hidden md:block ml-2 font-medium">
                                User Name
                            </span>
                            <icon-arrow-down />
                        </button>
                        <div
                            class="absolute z-50 top-0 -right-20 xs:-right-8 sm:right-0 w-[280px] sm:w-[300px] mt-14 p-4 rounded-lg shadow-xl bg-card"
                        >
                            <h5 class="text-body text-xs">Мой профиль</h5>
                            <div class="flex items-center mt-3">
                                <img
                                    src="@~/images/avatar.jpg"
                                    class="w-11 h-11 rounded-full"
                                    alt="Данил Шуцкий"
                                />
                                <span class="ml-3 text-xs md:text-sm font-bold">
                                    User Name
                                </span>
                            </div>
                            <div class="mt-4">
                                <ul class="space-y-2">
                                    <li>
                                        <a
                                            href="orders.html"
                                            class="text-body hover:text-white text-xs font-medium"
                                            >Мои заказы</a
                                        >
                                    </li>
                                    <li>
                                        <a
                                            href="edit-profile.html"
                                            class="text-body hover:text-white text-xs font-medium"
                                            >Редактировать профиль</a
                                        >
                                    </li>
                                </ul>
                            </div>
                            <div class="mt-6">
                                <form method="POST" action="/logout">
                                    <button
                                        type="submit"
                                        class="inline-flex items-center text-body hover:text-pink"
                                    >
                                        <icon-exit />
                                        <span class="ml-2 font-medium">
                                            Выйти
                                        </span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <a
                        href="cart.html"
                        class="flex items-center gap-3 text-pink hover:text-white"
                    >
                        <icon-cart />

                        <div class="hidden sm:flex flex-col gap-2">
                            <span class="text-body text-xxs leading-none">
                                3 шт.
                            </span>
                            <span
                                class="text-white text-xxs 2xl:text-xs font-bold !leading-none"
                            >
                                57 900 ₽
                            </span>
                        </div>
                    </a>

                    <burger-menu />
                </div>
            </div>
        </div>
    </header>
</template>

<script>
    import IconCart from '@/components/Icons/IconCart.vue'
    import BurgerMenu from '@/components/Header/BurgerMenu.vue'
    import IconExit from '@/components/Icons/IconExit.vue'
    import IconArrowDown from '@/components/Icons/IconArrowDown.vue'
    import IconProfile from '@/components/Icons/IconProfile.vue'
    import IconSearch from '@/components/Icons/IconSearch.vue'
    import NavigationMenu from '@/components/Header/NavigationMenu.vue'

    export default {
        name: 'NavigationHeader',
        components: {
            NavigationMenu,
            IconSearch,
            IconProfile,
            IconArrowDown,
            IconExit,
            BurgerMenu,
            IconCart
        }
    }
</script>

<style scoped></style>
