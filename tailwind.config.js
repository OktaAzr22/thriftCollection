/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: 'class', // ⬅️ ini WAJIB
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
