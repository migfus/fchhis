// vite.config.js
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'
import path from "path";

export default defineConfig({
    plugins: [
        vue(),
        laravel([
            'resources/js/app.ts',
        ]),
    ],
    resolve: {
        alias: {
            "@": path.resolve(__dirname, "./resources/js"),
        },
    },
    // NOTE remove console.log
    esbuild: {
        // drop: ['console', 'debugger'],
    },
});
