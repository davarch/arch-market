import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from '@/App.vue'
import router from '@/router'

import '@~/sass/main.sass'
import '@~/css/app.css'
import.meta.glob(['@~/images/**', '@~/fonts/**'])

const app = createApp(App)

app.use(createPinia())
app.use(router)

app.mount('#app')
