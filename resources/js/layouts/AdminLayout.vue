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
    <v-navigation-drawer
      v-model="drawer"
      color="primary lighten-1"
      app
      clipped
      floating
      dark
    >
      <template v-for="(group, index) in menuItems">
        <v-divider
          v-if="group.divider"
          :key="`${index}-divider`"
        />
        <v-list
          :key="index"
          nav
        >
          <v-subheader v-if="group.title">
            {{ group.title }}
          </v-subheader>
          <template v-for="item in group.items">
            <v-list-item
              v-if="checkMenuItemCondition(item)"
              :key="item.text"
              :href="route(item.link)"
              :class="route().current(getWildcard(item.link)) ? 'v-list-item--active' : ''"
              @click.prevent="go(route(item.link))"
            >
              <v-list-item-icon>
                <v-icon v-text="item.icon" />
              </v-list-item-icon>
              <v-list-item-content>
                <v-list-item-title>
                  {{ item.text }}
                </v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </template>
        </v-list>
      </template>

      <!-- Team Switcher -->
      <v-divider />

      <v-list
        flat
        nav
      />

      <!-- Authentication -->
      <template #append>
        <v-list
          nav
        >
          <v-list-item>
            <v-list-item-content>
              <form @submit.prevent="logout">
                <v-btn
                  block
                  color="accent darken-3"
                  type="submit"
                >
                  <v-icon v-text="'mdi-logout'" />
                  {{ $t('auth.logout') }}
                </v-btn>
              </form>
            </v-list-item-content>
          </v-list-item>
        </v-list>
      </template>
    </v-navigation-drawer>

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

export default {
  components: {
    FlashMessages,
    BrandLogo
  },
  data () {
    return {
      drawer: true,
      menuItems: [
        {
          divider: true,
          title: this.$t('nav.general.title'),
          items: [
            {
              text: this.$t('nav.general.dashboard'),
              link: 'dashboard',
              icon: 'mdi-view-dashboard'
              // condition: this.$page.props.jetstream.hasApiFeatures,
            }
          ]
        }
      ]
    }
  },
  methods: {
    /**
     * Checks if menu item has condition
     *
     * @param {object} item - Navigation item
     * @param {Boolean?} item.condition - Display condition
     * @returns {Boolean} Whether menu item should be shown or not
     */
    checkMenuItemCondition: item => {
      let visible = true

      if (Object.prototype.hasOwnProperty.call(item, 'condition')) {
        visible = item.condition
      }

      return visible
    },
    logout () {
      this.$inertia.post(route('logout'))
    },
    go (link) {
      this.$inertia.visit(link)
    },
    getWildcard (link) {
      return `${link.split('.')[0]}*`
    }
  }
}
</script>

<style scoped>
.v-app-bar__logo {
  filter: brightness(0) invert(1);
}
</style>
