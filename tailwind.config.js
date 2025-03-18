import defaultTheme from 'tailwindcss/defaultTheme';
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
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: '#4F46E5', // Un tono de azul vibrante
                secondary: '#F59E0B', // Un tono de naranja
                accent: '#10B981', // Un tono de verde
                background: '#F9FAFB', // Un fondo claro
                text: '#1F2937', // Un tono de gris oscuro para el texto
            },
        },
    },
plugins: [forms],
};
