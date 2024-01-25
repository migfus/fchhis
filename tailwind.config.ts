/** @type {import('tailwindcss').Config} */

const colors = require('tailwindcss/colors')

export default {
  // purge: ['.public//index.html', './resources/js/**/*.{vue,js,ts,jsx,tsx}'],
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
      extend: {
      colors: {
        'primary': colors.sky,
        'secondary': colors.emerald,
      },

      'keyframes': {
        'shimmer': {
          '100%': {
              "transform": "translateX(100%)",
          },
        },
      }
    },
  },
  plugins: [
      require('@tailwindcss/forms'),
  ],
  // NOTE for dynamic classes
  safelist: [
    'text-yellow-500',
    'ring-yellow-500'
  ]
}

