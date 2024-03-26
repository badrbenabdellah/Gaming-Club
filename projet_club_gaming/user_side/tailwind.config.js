/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./pages/*.{html,js,php}",
      "./*.{html,js,php}",
      "node_modules/preline/dist/*.js"
  ],
  theme: {
    extend: {
      colors: {
        'my-col': '#1F2039',
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('preline/plugin'),
  ],
}

