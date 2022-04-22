<template>
  <div>
    <h1>
    </h1>
    <h2>
    </h2>
  </div>

  <div class="card" v-for="orderItem in orders">
    kkk
<!--    <order-items-->
<!--        :key="orderItem.id"-->
<!--        :orderItem="orderItem"-->
<!--        @change-completed-status="changeCompletedStatus"-->
<!--    ></order-items>-->
  </div>
  <div id="goToOrders" class="card-footer text-muted fixed-bottom m-4" v-if="numberOfAllOrderItems">
    <router-link :to="{ name: 'shopkeeper' }" v-if="allOrderItemsAreCompleted">
      <button type="button" class="btn btn-primary btn-lg btn-block" style="width: 100%" @click="setOrderAsWaitingForDelivery">Skomplemetowane</button>
    </router-link>
    <button type="button" disabled class="btn btn-primary btn-lg btn-block" style="width: 100%" v-else>Skomplemetowane</button>
  </div>
</template>

<script>
import Order from "../../components/layout/shopService/shopkeeper/Order";
import OrderItems from "../../../vueService/components/layout/shopkeeper/OrderItems";
export default {
  components: {OrderItems, Order},
  props: ['shopId', 'orderId'],
  data() {
    return {
      // numberOfAllOrderItems: 0,
      numberOfCompletedOrderItems: 0,
      allOrderItemsAreCompleted: false

    }
  },
  computed: {
    orders() {
      // console.log(this.$store.getters['orders/getOrders'])
      return this.$store.getters['orders/getOrders'];
    },
    numberOfAllOrderItems() {
      // console.log(this.$store.getters['orders/getOrderItems'].length)
      return this.$store.getters['orders/getOrderItems'].length
    }
  },
  methods: {
    async loadOrderItems() {
      try {
        // var shopId = this.shopId;
        // console.log(this.orderId)
        parseInt(this.orderId);
        await this.$store.dispatch('orders/fetchOrderProductsInfo', {
          // shopId: this.shopId,
          orderId: this.orderId
        })
      } catch (error) {
      }
    },
    changeCompletedStatus(statusCompleted) {
      if (statusCompleted === true) {
        this.numberOfCompletedOrderItems += 1
      } else {
        this.numberOfCompletedOrderItems -= 1
      }
      // this.numberOfCompletedOrderItems = valueOfCompletedItems
    },
    async fetchOrderInfo() {
      console.log('ssas')
      // this.orderId = parseInt(this.order.id);
      await this.$store.dispatch('orders/fetchOrderInfo', {
        orderId: this.orderId
      })
    },
    async setOrderAsWaitingForDelivery() {
      await this.$store.dispatch('orders/setOrderAsWaitingForDelivery', {
        orderId: this.orderId
      })
    }
  },
  watch: {
    numberOfCompletedOrderItems: function (val) {
      this.allOrderItemsAreCompleted = val === this.numberOfAllOrderItems;
    }
  },
  created() {
    // this.fetchOrderInfo();
    // this.loadOrderItems();
  }
}
</script>


