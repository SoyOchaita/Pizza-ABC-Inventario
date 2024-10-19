const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: ['./**/*.blade.php'],
    darkMode: 'class',
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
    plugins: [],
};
