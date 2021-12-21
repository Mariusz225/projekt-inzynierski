<template>
  <the-navbar :isCart="isCart"></the-navbar>
  <router-view></router-view>

</template>

<script>
import TheHeader from './components/layout/TheNavbar'
import TheNavbar from "./components/layout/TheNavbar";
export default {
  name: "App",
  components: {TheNavbar},
  computed: {
    isLandingPage() {
      return this.$route.name === 'landingPage'
    },
    isCart() {
      // console.log(this.$store.getters['cart/isCart'])
      return this.$store.getters['cart/isCart']
    },
  },
  methods: {
    async downloadCartItems() {
      try {
        await this.$store.dispatch('cart/downloadCart')
      } catch (error) {

      }

    }
  },
  created() {
    this.downloadCartItems()
  }
}
</script>

<style>
@import'~bootstrap/dist/css/bootstrap.css';
</style>