// tailwind.config.js
export default {
  content: [
    './node_modules/preline/preline.js',
    './src/**/**/*.{html,js,vue}',
  ],
  theme: {
    extend: {},
  },
  variants: {
    extend: {},
  },
  plugins: [
    require('preline/plugin'),
  ],
}