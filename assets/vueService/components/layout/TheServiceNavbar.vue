<template>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-md navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#!">
        Panel pracowniczy
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
        </ul>
        <ul class="navbar-nav">
          <li class="nav-item">
            <button class="btn btn-secondary" @click="logout">Wyloguj się</button>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
export default {
  data() {
    return {

    }
  },
  methods: {
    logout() {

      window.location.replace('http://localhost:8000/login')
      return this.$store.dispatch('employee/logout');
    }
  },
}

</script>

<style>

</style>