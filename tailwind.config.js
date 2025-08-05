import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    safelist: [
        'line-border',
        'line-left',
        'line-right',
        'box-anim',
        'translate-x-0',
        'translate-x-full',
        'opacity-0',
        'opacity-100',
        
        'block',
        'hidden',
        'lg:block',
        'lg:hidden',
        'grid',
        'grid-cols-1',
        'sm:grid-cols-2',
        'gap-4',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
