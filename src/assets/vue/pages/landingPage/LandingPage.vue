<template>
  <header>
    <section class="header-content">
      <img src="https://cssanimation.rocks/levelup/public/images/rocky-dashed.svg" class="rocky-dashed">
      <h1 class="header-title">Your awesomes landing page</h1>
      <h3 class="header-subtitle">A useful start for your projects</h3>
      <p class="header-button"><a href="http://courses.cssanimation.rocks/p/level-up" class="button">Get started today</a></p>
    </section>
  </header>
</template>

<script>
import BaseCard from "../../components/ui/BaseCard";
export default {
  components: {BaseCard}
}
</script>

<style scoped>
header {
  align-items: center;
  display: flex;
  font-size: 18px;
  height: 100vh;
  justify-content: center;
  overflow: hidden;
  position: relative;
  text-align: center;
  transform-style: preserve-3d;
  perspective: 100px;
}

header:before {
  background: linear-gradient(to bottom, rgba(0,0,0,0), rgba(0,0,0,.8)),
  url(https://image.freepik.com/free-photo/flat-lay-assortment-vegetables_23-2148853350.jpg) no-repeat bottom;
  background-size: cover;
  content: "";
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  z-index: -1;
}

/*header:after {*/
/*  background: #F9FCFF;*/
/*  content: "";*/
/*  height: 40rem;*/
/*  !*left: -5%;*!*/
/*  !*position: absolute;*!*/
/*  right: -5%;*/
/*  top: 90%;*/
/*  transform-origin: 0 0;*/
/*  transform: rotateZ(-4deg);*/
/*  z-index: 0;*/
/*}*/

.header-title, .header-subtitle {
  color: #fff;
}

.header-subtitle {
  text-transform: uppercase;
  margin-bottom: 5rem;
}

.header-button {
  transform: translateZ(.1px);
  position: relative;
  z-index: 10;
}

</style>
