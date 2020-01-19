<template>
  <v-app>
    <Navbar v-if="checkLogin"></Navbar>
    <v-content>
      <router-view></router-view>
    </v-content>
    <Footer v-if="checkLogin" />
  </v-app>
</template>

<script>
import Navbar from '@/components/Navbar'
import Footer from '@/components/Footer'
export default {
  components: {
    Navbar,
    Footer
  },
  name: 'App',

  data: () => {
    return {
      open: false
    }
  },
  computed: {
    checkLogin() {
      if (this.$route.fullPath == '/login') return false
      if (this.$route.fullPath == '/registration') return false
      return true
    }
  }
}
</script>

<style scoped>
.w-3 {
  width: 50px !important;
}

html {
  scroll-behavior: smooth !important;
}
</style>
