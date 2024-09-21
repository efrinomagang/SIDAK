import laravel from 'laravel-vite-plugin';
import { defineConfig } from 'vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
// import { defineConfig } from 'vite';
// import laravel from 'vite-plugin-laravel';

// export default defineConfig({
//   plugins: [laravel()],
//   css: {
//     postcss: {
//       plugins: [require('tailwindcss'), require('autoprefixer')],
//     },
//   },
// });
