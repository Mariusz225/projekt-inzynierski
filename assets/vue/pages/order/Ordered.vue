<template>
  <div class="container">
    <div class="card">
<!--      <div class="card-header">-->
<!--        Featured-->
<!--      </div>-->
      <div class="card-body">
        <h5 class="card-title">Dziękujemy za zrobienie zakupów</h5>
        <p class="card-text">Nasz kierowca się z Państwem skontaktuje</p>
        <router-link :to="{ name: 'landingPage' }">
          <button class="btn btn-primary" >Wróć na stronę główną.</button>
        </router-link>
      </div>
    </div>
  </div>

</template>

<script>
export default {
}
</script>