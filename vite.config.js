import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import vue from '@vitejs/plugin-vue';
import path from 'path';
import flowbite from 'flowbite-vue/plugin';

export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/css/app.css', 'resources/js/app.js'],
      refresh: true,
    }),
    tailwindcss(),
    vue({ // <--- Configuration for Vue
      template: {
        transformAssetUrls: {
          base: null,
          includeAbsolute: false,
        },
      },
    }),
    flowbite(),
  ],
  resolve: {
    alias: {
      '@': path.resolve(__dirname, 'resources/js'),
      '@img': path.resolve(__dirname, 'resources/img'),
    },
  },
});
