import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/icons/icons.css',
                'resources/css/compiled/authentication.css',
                'resources/css/compiled/home-page.css',
                'resources/css/compiled/main-app.css',

                'resources/js/app.js'
            ],
            refresh: true,
        }),
    ],
});
