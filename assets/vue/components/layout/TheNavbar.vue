<template>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-md navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="" @click="goToShopWhereIsCart">
          Sklep
          <!--      <img src="https://mdbootstrap.com/img/logo/mdb-transaprent-noshadows.png" height="30" alt="mdb logo">-->
        </a>

      <!-- Collapse button -->
<!--      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav1"-->
<!--              aria-controls="basicExampleNav1" aria-expanded="false" aria-label="Toggle navigation">-->
<!--        <span class="navbar-toggler-icon"></span>-->
<!--      </button>-->
      <!-- Links -->
      <div class="" id="navbarSupportedContent">
        <!-- Right -->
        <ul class="navbar-nav me-auto">
        </ul>
        <ul class="navbar-nav m-0">
          <li class="nav-item" v-if="shopIdWhereIsCart">
            <router-link :to="{ name: 'cart' }">
              <a href="#!" class="nav-link waves-effect">
                Koszyk
              </a>
            </router-link>

          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
export default {
  props: ['shopIdWhereIsCart'],
  // computed: {
  //   isCart() {
  //     return this.$store.getters['cart/isCart']
  //   },
  // }
  methods: {
    goToShopWhereIsCart() {
      if (this.shopIdWhereIsCart) {
        // console.log('xd')
        this.$router.push({name: 'shop', params: {shopId: this.shopIdWhereIsCart}})
      } else  {
        this.$router.push({name: 'landingPage'})
      }
      // this.$router.push({name})
    }
  }
}

</script>

<style>

</style>