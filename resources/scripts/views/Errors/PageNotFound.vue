<template>
    <div class="container">
        <h1 class="text-2xl font-black text-center">Ошибка 404</h1>
        <p class="max-w-[720px] mx-auto mt-4 text-body text-center">
            Похоже, что данная страница не найдена, вы можете вернуться на
            главную страницу.
        </p>

        <div class="mt-8 text-center">
            <router-link to="/" class="btn btn-pink">
                Вернутся на главную
            </router-link>
        </div>
    </div>
</template>

<script>
    import { defineComponent } from 'vue'

    export default defineComponent({
        name: 'PageNotFound'
    })
</script>
