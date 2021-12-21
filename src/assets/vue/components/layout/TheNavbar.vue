<template>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-md navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#!">
        sklep
        <!--      <img src="https://mdbootstrap.com/img/logo/mdb-transaprent-noshadows.png" height="30" alt="mdb logo">-->
      </a>
      <!-- Collapse button -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav1"
              aria-controls="basicExampleNav1" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Links -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Right -->
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a href="#!" class="nav-link waves-effect">
              Kategorie
            </a>
          </li>
        </ul>
        <ul class="navbar-nav m-0">
          <li class="nav-item" v-if="isCart">
            <router-link :to="{ name: 'cart' }">
              <a href="#!" class="nav-link waves-effect">
                Koszyk
              </a>
            </router-link>

          </li>
          <li class="nav-item">
            <a href="#!" class="nav-link waves-effect">
              Sign in
            </a>
          </li>
          <li class="nav-item pl-2 mb-2 mb-md-0">
            <a href="#!" type="button"
               class="btn btn-outline-info btn-md btn-rounded btn-navbar waves-effect waves-light">Sign up</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
export default {
  props: ['isCart']
  // computed: {
  //   isCart() {
  //     return this.$store.getters['cart/isCart']
  //   },
  // }
}

</script>

<style>

</style>