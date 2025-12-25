import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', "resources/css/admin.css", 'resources/js/account.js', 'resources/js/profile.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
