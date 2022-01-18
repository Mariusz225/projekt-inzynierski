<template>
  <the-navbar :isCart="isCart"></the-navbar>
<!--  <change-viewed-shop :viewedShopId="viewedShopId"></change-viewed-shop>-->
  <div v-if="badViewedShop">TODO: nie można dodać z innego sklepu</div>
  <router-view></router-view>

</template>

<script>
import TheHeader from './components/layout/TheNavbar'
import TheNavbar from "./components/layout/TheNavbar";
import ChangeViewedShop from "./components/layout/shops/ChangeViewedShop";
export default {
  name: "App",
  components: {TheNavbar, ChangeViewedShop},
  computed: {
    isLandingPage() {
      return this.$route.name === 'landingPage'
    },
    isCart() {
      return this.$store.getters['cart/isCart']
    },
    badViewedShop() {
      return this.$store.getters['cart/badViewedShop']
    }
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
    this.downloadCartItems();

  }
}
</script>

<style>
@import'~bootstrap/dist/css/bootstrap.css';
</style>