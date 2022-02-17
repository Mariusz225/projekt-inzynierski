<template>
  <div>
    sasa
    <div class="card-body d-flex">
      <div class="">
        <div class="m-2" v-if="isImportant">
          <font-awesome-icon :icon="['fas', 'exclamation']" class="fa-2x" style="color:red"></font-awesome-icon>
        </div>
      </div>
      <div class="me-auto p-2 d-flex">


        <div class="m-auto">
          Zamówienie-{{order.id}}
          <time>{{ order.date }}</time>


          <!--          {{orderIsImportant}}-->
        </div>

      </div>
<!--      <router-link :to="{name: 'completingTheOrder', params: {orderId: order.id}}">-->
        <button class="p-2 btn" @click="goToCompletingOrder">
          <font-awesome-icon :icon="['fas', 'arrow-circle-right']" class="fa-2x" style="color:green"></font-awesome-icon>
        </button>
<!--      </router-link>-->

    </div>
  </div>
</template>

<script>
export default {
  props: ['order'],
  data() {
    return {
    }
  },
  computed: {
    isImportant() {
      // console.log(this.order.date)
      if (this.order.date) {

      }
      const today = new Date();
      const tomorrow = new Date(today)
      tomorrow.setDate(tomorrow.getDate() + 1)
      tomorrow.setHours(0, 0, 0, 0)

      const dateDelivery = new Date(this.order.date);
      dateDelivery.setHours(0, 0, 0, 0)


      if (dateDelivery <= tomorrow) {
        return true;
      }

    }
  },
  methods: {
    async goToCompletingOrder() {
      // console.log(this.order.id)
      this.orderId = parseInt(this.order.id);
      var response = await this.$store.dispatch('orders/fetchOrderInfo', {
        orderId: this.orderId
      })
      console.log(response)
      if (response === 'cart') {
        console.log('nie da rady')
      } else {
        console.log('sss')
      }
    },
  }
}
</script>