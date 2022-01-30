<template>
  <div>
    <h1>
<!--      {{shopId}} - {{orderId}}-->
    </h1>
    <h2>
<!--      {{numberOfAllOrderItems}}-->
<!--      {{numberOfCompletedOrderItems}}-->
<!--      {{allOrderItemsAreCompleted}}-->
    </h2>
  </div>

  <div class="card" v-for="orderItem in orderItems">
    <order-items
        :key="orderItem.id"
        :orderItem="orderItem"
        @change-completed-status="changeCompletedStatus"
    ></order-items>
<!--    {{orderItem.id}}-->
<!--    <div class="d-flex">-->
<!--      &lt;!&ndash;          <div class="col-auto ">&ndash;&gt;-->
<!--      &lt;!&ndash;            <img src="https://picsum.photos/200" class="img-product " alt="...">&ndash;&gt;-->
<!--      &lt;!&ndash;          </div>&ndash;&gt;-->
<!--      <div class="float-start">-->
<!--        <img class="img-order-item"-->
<!--             src="https://picsum.photos/200" alt="Sample">-->
<!--      </div>-->

<!--      <div class="card-body d-flex col-8">-->
<!--        <div class="me-auto p-2 text-wrap">-->
<!--          {{ orderItem.quantity }} x {{ orderItem.productShop.products.name }}-->

<!--        </div>-->
<!--        <div class="p-2 mb-auto mt-auto">-->
<!--&lt;!&ndash;          <div>&ndash;&gt;-->
<!--&lt;!&ndash;            {{ orderItem.quantity }}&ndash;&gt;-->
<!--&lt;!&ndash;          </div>&ndash;&gt;-->
<!--&lt;!&ndash;          Komplemetuj&ndash;&gt;-->
<!--          <font-awesome-icon :icon="['far', 'check-circle']" class="fa-4x" style="color:green"></font-awesome-icon>-->
<!--&lt;!&ndash;          <font-awesome-icon :icon="['fas', 'check-circle']" class="fa-4x" style="color:green"></font-awesome-icon>&ndash;&gt;-->
<!--        </div>-->
<!--      </div>-->
<!--    </div>-->

<!--    <order-->
<!--        :key="order.id"-->
<!--        :order="order"-->
<!--    ></order>-->
  </div>
  <div id="goToOrders" class="card-footer text-muted fixed-bottom m-4" v-if="numberOfAllOrderItems">
    <router-link :to="{ name: 'shopkeeper' }" v-if="allOrderItemsAreCompleted">
      <button type="button" class="btn btn-primary btn-lg btn-block" style="width: 100%" @click="setOrderAsWaitingForDelivery">Skomplemetowane</button>
    </router-link>
    <button type="button" disabled class="btn btn-primary btn-lg btn-block" style="width: 100%" v-else>Skomplemetowane</button>
  </div>
</template>

<script>
import Order from "../../components/layout/employee/shopkeeper/Order";
import OrderItems from "../../components/layout/employee/completingTheOrder/OrderItems";
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
    orderItems() {
      // console.log(this.$store.getters['orders/getOrderItems'])
      return this.$store.getters['orders/getOrderItems']
      // return ['s','s']
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
    this.fetchOrderInfo();
    this.loadOrderItems();
  }
}
</script>


