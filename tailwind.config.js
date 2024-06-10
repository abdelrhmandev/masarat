const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
    mode: 'jit',
    content: ['./resources/**/*.blade.php', './resources/**/*.js', "./node_modules/flowbite/**/*.js"],
    theme: {
        fontFamily: {
            cairo: ['cairo']
        },
        extend: {
            colors: {
                primary: '#4c83ff',
                'primary-dark': '#1960ff',
                secondary: '#6fbb57',
                tertiary: '#f0ad4e',
                accent: '#aaaca9',
                'accent-dark': '#4e504d',
                'light-gray': '#e6e7e9',
                'dark-gray': '#5e5e5e',
                green: '#0dcca7'
            }
        }
    },
    plugins: [require('@tailwindcss/forms'), require('flowbite/plugin')]
}
