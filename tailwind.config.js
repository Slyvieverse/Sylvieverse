import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    darkMode: 'class', // This line enables dark mode based on the 'dark' class
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                poppins: ['Poppins', 'sans-serif'],
                'roboto-serif': ['Roboto Serif', 'serif'],
            },
            colors: {
                text: {
                    50: '#f0f1f5', 100: '#e0e4eb', 200: '#c2c9d6', 300: '#a3adc2',
                    400: '#8592ad', 500: '#667799', 600: '#525f7a', 700: '#3d475c',
                    800: '#29303d', 900: '#14181f', 950: '#0a0c0f',
                },
                background: {
                    50: '#f0f2f5', 100: '#e0e6eb', 200: '#c2ccd6', 300: '#a3b3c2',
                    400: '#8599ad', 500: '#667f99', 600: '#52667a', 700: '#3d4c5c',
                    800: '#29333d', 900: '#14191f', 950: '#0a0d0f',
                },
                primary: {
                    50: '#f8e7fe', 100: '#f1cefd', 200: '#e39dfb', 300: '#d66cf9',
                    400: '#c83bf7', 500: '#ba0af5', 600: '#9508c4', 700: '#700693',
                    800: '#4a0462', 900: '#250231', 950: '#130118',
                },
                secondary: {
                    50: '#f3eff5', 100: '#e7dfec', 200: '#d0c0d8', 300: '#b8a0c5',
                    400: '#a081b1', 500: '#89619e', 600: '#6d4e7e', 700: '#523a5f',
                    800: '#37273f', 900: '#1b1320', 950: '#0e0a10',
                },
                accent: {
                    50: '#f5eff4', 100: '#ebe0e9', 200: '#d8c0d3', 300: '#c4a1bd',
                    400: '#b082a7', 500: '#9d6291', 600: '#7d4f74', 700: '#5e3b57',
                    800: '#3f273a', 900: '#1f141d', 950: '#100a0f',
                },
            },
        },
    },
    plugins: [forms],
};
