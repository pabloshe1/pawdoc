import defaultTheme from 'tailwindcss/defaultTheme'; // <--- Perhatikan ini: 'tailwindcss', bukan 'tailwind.config.js'
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                // Ini biar font Chakra Petch yang kita pasang di layout tadi aktif
                sans: ['Chakra Petch', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};