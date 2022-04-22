<template>
  <div>
    <div class="card-body d-flex">
      <div class="">
      </div>
      <div class="me-auto p-2 d-flex" @click="">

        <div class="m-auto">
          Zamówienie {{order.id}}<br>
          {{ order.town }} => {{order.street}}

        </div>

      </div>

      <div class="p-2">
<!--        <a :href="`tel:+${ mobile }`"><i class="fas fa-mobile"></i></a>-->
        <button class="p-2 btn" @click="callToNumber(order.phoneNumber)">
          <font-awesome-icon :icon="['fas', 'mobile-alt']" class="fa-2x"></font-awesome-icon>
        </button>


      </div>
      <div class="p-2">
        <button class="p-2 btn" @click="navigate()">
          <font-awesome-icon :icon="['fas', 'location-arrow']" class="fa-2x"></font-awesome-icon>
        </button>
      </div>
      <div class="p-2">
        <button class="btn btn-primary">
          Dostarczone
<!--          {{order }}-->
        </button>
      </div>



    </div>
  </div>
</template>

<script>
export default {
  props:['order'],
  data () {
    return {
      mobile: '8001234567'
    }
  },
  methods: {
    callToNumber(number) {
      window.location ='tel:'+number;
    },
    navigate() {
      var address = this.order.street;
      address = address.replace(/\s+/g, '+').toLowerCase();
      var postCodeAndTown = this.order.postcode + '+' + (this.order.town).replace(/\s+/g, '+').toLowerCase();
      window.open('https://www.google.pl/maps/dir/' + address + ',' + postCodeAndTown)
    }
  }
}
</script>