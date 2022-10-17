import HomeIndex from '@/views/Home/HomeIndex.vue'
import type { RouteRecordRaw } from 'vue-router'

const routes: RouteRecordRaw[] = [
    {
        path: '/',
        name: 'home',
        component: HomeIndex,
        meta: {
            layout: 'AppLayout'
        }
    },
    {
        path: '/:pathMatch(.*)*',
        name: '404',
        component: () => import('@/views/Errors/PageNotFound.vue'),
        meta: {
            layout: 'GuestLayout'
        }
    }
]

export default routes
