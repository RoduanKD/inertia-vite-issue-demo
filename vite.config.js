import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import { createVuePlugin } from 'vite-plugin-vue2'
import Components from 'unplugin-vue-components/vite'
import { VuetifyResolver } from 'unplugin-vue-components/resolvers'
import eslint from 'vite-plugin-eslint'

export default defineConfig({
  resolve: {
    alias: {
      '@': '/resources/js',
    },
  },
  css: {
    preprocessorOptions: {
      sass: {
        additionalData: [
          '@import "./resources/styles/styles.scss"',
          '',
        ].join('\n'),
      },
    },
  },
  plugins: [
    laravel([
      'resources/css/app.css',
      'resources/js/app.js',
    ]),
    createVuePlugin({
      template: {
        transformAssetUrls: {
          base: null,
          includeAbsolute: false,
        },
      },
    }),
    Components({
      resolvers: [VuetifyResolver()],
    }),
    eslint({ fix: true }),
  ],
})
