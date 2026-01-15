// tailwind.config.js
import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
    './resources/**/*.js',
  ],

  theme: {
    extend: {
      fontFamily: {
        sans: ['Figtree', ...defaultTheme.fontFamily.sans],
      },
      colors: {
        navy: {
          950: '#07162E',
          900: '#0B1F3B',
          800: '#12305A',
        },
        gold: {
          500: '#F5C542',
          600: '#EAB308',
        },
        wa: {
          500: '#26C467',
        },
      },
    },
  },

  plugins: [forms],
};
