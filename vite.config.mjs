import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import path from 'path';
 
export default defineConfig({
    plugins: [
        laravel(['resources/js/app.js']),
        vue({
            template: {
                transformAssetUrls: {

                    base: null,
 
                    
                    includeAbsolute: false,
                },
            },
        }),
    ],
    resolve: {
        alias: {
          vue: 'vue/dist/vue.esm-bundler.js',
          '@': path.resolve(__dirname, 'resources/js'),
        },
      },
});