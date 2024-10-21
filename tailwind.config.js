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
                sans: ['Figtree', 'Montserrat','sans-serif', ...defaultTheme.fontFamily.sans],
            },
            fontWeight: {
                normal: '400',
                extrabold: '800',
            },
            colors: {
                stone: {
                    900: '#1c1917',
                    800: '#292524'
                }
            }



        },
    },

plugins: [forms],
};
