import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 
                "resources/css/admin.css", 
                "resources/css/FAQ.css", 
                'resources/js/account.js', 
                'resources/js/profile.js', 
                'resources/js/news.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
