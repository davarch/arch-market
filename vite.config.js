import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import vue from '@vitejs/plugin-vue'

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/js/app.js', 'resources/scripts/main.ts'],
            refresh: true
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: true
                }
            }
        })
    ],

    resolve: {
        alias: {
            '@': '/resources/scripts',
            '@~': '/resources'
        }
    },

    server: {
        hmr: {
            host: 'localhost'
        }
    },

    optimizeDeps: {
        esbuildOptions: {
            target: 'es2021'
        }
    },

    build: {
        target: 'es2021'
    }
})
