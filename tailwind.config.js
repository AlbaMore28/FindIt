/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        'blue-gray-dark' : '#637190',
        'blue-gray': '#8593AE',
        'steel': '#A3AABC',
        'pewter': '#7E675E',
        'blush':  '#DBC0A8',
      },
      height: {
        '128': '481px',
        '300': '621.6px',
        '400': '721.6px',
        '864': '864px'
      },
      minHeight: {
        'inherit': 'inherit'
      },
      width: {
        '400': '721.6px',
        '700': '1012px',
        '800': '800px',
        '1280': '1280px'
      }
    },
  },
  plugins: [],
}
