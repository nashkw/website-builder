import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
        './generated-site/src/**/*.vue',
        'node_modules/preline/dist/*.js',
    ],

    darkMode: 'class',

    theme: {},

    plugins: [
        require('preline/plugin'),
        forms,
    ],
};
