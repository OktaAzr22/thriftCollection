module.exports = {
  darkMode: 'class',
  content: [
    './resources/views/**/*.blade.php',
    './resources/js/**/*.js',
  ],
  theme: {
    extend: {
       colors: {
        primary: '#1A56DB',
        secondary: '#7B61FF',
        dark: '#1F2937',
        light: '#F9FAFB',
        danger: '#EF4444',
       },
    },
  },
  plugins: [],
};
