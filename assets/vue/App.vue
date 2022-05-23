<template>
  <the-navbar :shopIdWhereIsCart="shopIdWhereIsCart"></the-navbar>
<!--  <change-viewed-shop :viewedShopId="viewedShopId"></change-viewed-shop>-->
<!--  <div v-if="badViewedShop">Nie można dodać z innego sklepu</div>-->
<!--  {{userHasCartInOtherShop}}-->
  <router-view></router-view>

</template>

<script>
import TheNavbar from "./components/layout/TheNavbar";
export default {
  name: "App",
  components: {TheNavbar},
  computed: {
    // isLandingPage() {
    //   return this.$route.name === 'landingPage'
    // },
    shopIdWhereIsCart() {
      console.log(this.$store.getters['cart/getShopId']);
      return this.$store.getters['cart/getShopId']
      //TODO
      // return this.$store.getters['cart/isCart']
    },
    // //TODO ID sklepu gdzie jest koszyk
    // userHasCartInOtherShop() {
    //
    //   console.log(this.$store.getters['cart/getShopId']);
    // },
    // badViewedShop() {
    //   return this.$store.getters['cart/badViewedShop']
    // }
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
/*@import'~bootstrap/js/dist/collapse.js';*/

/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
</style>