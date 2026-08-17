/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./*.php", "./components/**/*.php"],
  theme: {
    extend: {
      colors: {
        teal: {
          light: '#53a8b6',
          DEFAULT: '#368997',
          dark: '#246b77',
        }
      },
      fontFamily: {
        sans: ['"Inter"', 'sans-serif'],
      }
    },
  },
  plugins: [],
}
