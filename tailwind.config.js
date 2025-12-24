/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
theme: {
    extend: {
      colors: {
        'blue': {
          900: '#1e3a8a',
          800: '#1e40af',
          700: '#1d4ed8',
          600: '#2563eb',
          500: '#3b82f6',
        }
      },
      fontFamily: {
            tiktok: ['TikTok Sans', 'sans-serif'], 
            rubik: ['Rubik', 'sans-serif'], 
          },
    },
  },
  plugins: [],
}

