<template>
  <div class="card" v-for="order in orders">
<!--    <div>-->
<!--      <div class="card-body d-flex">-->
<!--        <div class="me-auto p-2">-->
<!--          Zamówienie-{{order.id}}-->
<!--          <time>{{ order.date }}</time>-->
<!--          <div>-->
<!--            {{orderIsImportant}}-->
<!--          </div>-->

<!--        </div>-->
<!--        <div class="p-2">-->
<!--          Komplemetuj-->
<!--        </div>-->
<!--      </div>-->
<!--    </div>-->
    <order
        :key="order.id"
        :order="order"
    ></order>
  </div>
</template>

<script>
import Order from "../../components/layout/employee/shopkeeper/Order";
export default {
  components: {Order},
  props: ['shopId'],
  computed: {
    orders() {
      // console.log(this.$store.getters['orders/getOrders'])
      return this.$store.getters['orders/getOrders'];
    },
    orderIsImportant() {
      const order = this.$store.getters['orders/isImportant'];
      // return coaches.filter((coach) => {
      //   if (this.activeFilters.frontend && coach.areas.includes('frontend')) {
      //     return true;
      //   }
      //   if (this.activeFilters.backend && coach.areas.includes('backend')) {
      //     return true;
      //   }
      //   if (this.activeFilters.career && coach.areas.includes('career')) {
      //     return true;
      //   }
      //   return false;
      // });
    },
  },
  methods: {
    async loadOrders() {
      try {
        // var shopId = this.shopId;
        // console.log(shopId)
        await this.$store.dispatch('orders/getOrdersFromTheStore', {
          shopId: this.shopId
        })
      } catch (error) {
      }
    }
  },
  created() {
    //TODO error kiedy cofa się stronę
    this.loadOrders();
  }
}
</script>