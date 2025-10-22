/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./app/views/**/*.php", // Scans all .php files in the views folder
    "./public/index.php"    // Scans the main index file
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}