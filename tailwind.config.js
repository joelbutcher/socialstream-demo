const defaultColors = require('tailwindcss/colors')

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['poppins', 'ui-sans-serif', 'system-ui', '-apple-system', '"Helvetica Neue"', 'Arial', 'sans-serif'],
            },
            boxShadow: {
                'reverse-sm': '0 -1px 2px 0 rgba(0, 0, 0, 0.05);',
                reverse: '0 -1px 3px 0 rgba(0, 0, 0, 0.1), 0 -1px 2px 0 rgba(0, 0, 0, 0.06);',
                'reverse-md': '0 -4px 6px -1px rgba(0, 0, 0, 0.1), 0 -2px 4px -1px rgba(0, 0, 0, 0.06);',
                'reverse-lg': '0 -10px 15px -3px rgba(0, 0, 0, 0.1), 0 -4px 6px -2px rgba(0, 0, 0, 0.05);',
                'reverse-xl': '0 -20px 25px -5px rgba(0, 0, 0, 0.1), 0 -10px 10px -5px rgba(0, 0, 0, 0.04);',
                'reverse-2xl': '0 -25px 50px -12px rgba(0, 0, 0, 0.25);',
            },
            colors: {
                primary: defaultColors.indigo,
                secondary: {
                    DEFAULT: '#FF6600',
                    '50': '#FFEDE0',
                    '100': '#FFE0CC',
                    '200': '#FFC8A3',
                    '300': '#FFAF7A',
                    '400': '#FF9752',
                    '500': '#FF7E29',
                    '600': '#FF6600',
                    '700': '#C75000',
                    '800': '#8F3900',
                    '900': '#572300'
                },
            },
            rotate: {
                '-180': '-180deg',
                '-90': '-90deg',
                '-45': '-45deg',
                '0': '0',
                '45': '45deg',
                '90': '90deg',
                '135': '135deg',
                '180': '180deg',
                '270': '270deg',
            },
            transitionProperty: {
                width: 'width',
            }
        },
    },
    plugins: [
        require('tailwindcss-opentype'),
        require('@tailwindcss/forms'), // eslint-disable-line
        require('@tailwindcss/typography'), // eslint-disable-line
    ],
};
