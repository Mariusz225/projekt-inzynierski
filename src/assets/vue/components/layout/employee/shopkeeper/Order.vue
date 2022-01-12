<template>
  <div>
    <div class="card-body d-flex">
      <div class="">
        <div class="m-2" v-if="isImportant">
          <font-awesome-icon :icon="['fas', 'exclamation']" class="fa-2x" style="color:red"></font-awesome-icon>
        </div>
      </div>
      <div class="me-auto p-2 d-flex">


<!--        <time>{{ order.date }}</time>-->
        <div class="m-auto">
          Zamówienie-{{order.id}}

          <!--          {{orderIsImportant}}-->
        </div>

      </div>
      <router-link :to="{name: 'completingTheOrder', params: {orderId: order.id}}">
        <div class="p-2">
          <font-awesome-icon :icon="['fas', 'arrow-circle-right']" class="fa-2x" style="color:green"></font-awesome-icon>
        </div>
      </router-link>

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
}
</script>