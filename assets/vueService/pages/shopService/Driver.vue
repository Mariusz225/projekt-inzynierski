<template>
<!--  <div>-->
<!--    sd-->
<!--  </div>-->
  <div v-if="!driverHasStartedDelivery">
    <div class="card" v-for="order in orders">

      <completing-the-order
          :key="order.id"
          :order="order"
          @change-status="changeStatus"
      ></completing-the-order>
    </div>

    <div id="goToOrders" class="card-footer text-muted fixed-bottom m-4" v-if="numberOfAllOrders">
      <div v-if="allOrdersAreCompleted">
        <button type="button" class="btn btn-primary btn-lg btn-block" style="width: 100%" @click="goToDelivery">Idź do dostawy</button>
      </div>
      <button type="button" disabled class="btn btn-primary btn-lg btn-block" style="width: 100%" v-else>Idź do dostawy</button>
    </div>

  </div>


  <div v-else>
    <div class="card" v-for="order in orders">
      <order
          :key="order.id"
          :order="order"
      ></order>
    </div>
  </div>



<!--  <div v-if="ordersAreLoaded">-->
<!--    <div v-if="xd === true">-->
<!--      sss-->
<!--    </div>-->

<!--  </div>-->



</template>

<script>
import Order from "../../components/layout/shopService/driver/Order";
import CompletingTheOrder from "../../components/layout/shopService/driver/CompletingTheOrder";
export default {
  components: {CompletingTheOrder, Order},
  props: ['shopId'],
  data() {
    return {
      // numberOfAllOrderItems: 0,
      numberOfCompletedOrders: 0,
      allOrdersAreCompleted: false,
      // driverWorkStatus: 'waitingForDelivery',
      // driverWorkStatus: null

      ordersAreLoaded: false,
      xd: null

    }
  },
  computed: {
    orders() {
      // console.log(this.$store.getters['orders/getOrders'])
      if (this.$store.getters['orders/getOrders'].length === 0) {
        this.xd = true
      } else this.xd = false
      return this.$store.getters['orders/getOrders'];
    },
    numberOfAllOrders() {
      // console.log(this.$store.getters['orders/getOrderItems'].length)
      return this.$store.getters['orders/getOrders'].length
    },
    driverHasStartedDelivery() {
      return this.$store.getters['employee/checkIfDriverHasStartedOrder'];
    }
  },

  methods: {
    async loadOrders() {
      // console.log('ss')
      try {
        await this.$store.dispatch('orders/getDriverOrdersInShop', {
          shopId: this.shopId
        })
      } catch (error) {
      }
      this.ordersAreLoaded = true
    },
    changeStatus(status) {
      if (status === true) {
        this.numberOfCompletedOrders += 1
      } else {
        this.numberOfCompletedOrders -= 1
      }
      // this.numberOfCompletedOrderItems = valueOfCompletedItems
    },
    async goToDelivery() {
      await this.$store.dispatch('orders/setOrdersAsDelivery', {
        // orderId: this.orderId
      })
      await this.$router.push({name: "completingTheOrderDriver"})

    },
    async checkIfDriverHasStartedDelivery() {
      try {
        await this.$store.dispatch('employee/checkIfDriverHasStartedDelivery', {
          shopId: this.shopId
        })
      } catch (error) {
      }
    },
  },

  watch: {
    numberOfCompletedOrders: function (val) {
      this.allOrdersAreCompleted = val === this.numberOfAllOrders;

    }
  },
  created() {
    this.checkIfDriverHasStartedDelivery();
    this.loadOrders();
  }
}
</script>