module.exports = {
  mode: 'jit',
  purge: ['./src/**/*.{html,js,svelte,ts}'],
  darkMode: 'class',
  theme: {
    extend: {
      colors: {
        transparent: 'transparent',
        current: 'currentColor',
        brand: 'rgb(230,107,13)',
      }
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}
