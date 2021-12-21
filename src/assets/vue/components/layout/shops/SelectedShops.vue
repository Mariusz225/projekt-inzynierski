<template>
  <div class="col-lg-3">

    <div class="btn-group" role="group" aria-label="Basic example">
      <!--    <button type="button" class="btn btn-secondary">Left</button>-->
      <button type="button" class="btn btn-secondary col-6 m-1 mt-3">Dostawa</button>
      <button type="button" class="btn btn-secondary col-6 m-1 mt-3">{{ deliveryOrPickup }}</button>
    </div>
  </div>
</template>

<script>
  export default {
    props: ['deliveryOrPickup'],
    data() {
      return{

      }
    }
  }
</script>