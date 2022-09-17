import Vue from 'vue'
import Vuetify from 'vuetify/lib/framework'
import { VBtn } from 'vuetify/lib'

Vue.use(Vuetify, {
  components: {
    VBtn,
  },
})

export default new Vuetify({
  theme: {
    themes: {
      light: {
        primary: '#001e4f',
        secondary: '#f88e2d',
        accent: '#8c9eff',
        error: '#b71c1c',
      },
    },
    options: { customProperties: true },
  },
  breakpoint: {
    mobileBreakpoint: 'xs',
  },
})
