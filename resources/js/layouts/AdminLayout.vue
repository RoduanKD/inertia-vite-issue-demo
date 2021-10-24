<template>
  <v-app>
    <v-app-bar
      app
      clipped-left
      color="primary"
      dark
    >
      <v-app-bar-nav-icon @click="drawer = !drawer" />
      <v-app-bar-title>
        <v-img
          width="75"
        >
          <brand-logo background="primary" />
        </v-img>
      </v-app-bar-title>
    </v-app-bar>

    <side-bar :key="route().current()" />

    <!-- Sizes your content based upon application components -->
    <v-main style="background-color: #ECECEC;">
      <!-- Provides the application the proper gutter -->
      <flash-messages />
      <transition>
        <slot />
      </transition>
    </v-main>

    <v-footer
      app
      small
    >
      &copy; {{ new Date().getFullYear() }} Infinite Info
    </v-footer>
  </v-app>
</template>

<script>
import BrandLogo from '@/components/Identity/Logo'
import FlashMessages from '@/components/Layout/FlashMessages'
import SideBar from '@/components/Layout/SideBar'

export default {
  components: {
    FlashMessages,
    BrandLogo,
    SideBar
  }
}
</script>
