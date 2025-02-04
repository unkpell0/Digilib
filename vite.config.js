import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
            // detectTls: 'https://20c9-114-10-46-25.ngrok-free.app/', 
        }),
    ],
    // server: {
    //     host: true, // Pastikan ini sesuai
    //     port: 8000, // Port default Vite
    // },
});
