<template>
  <div>
    <h1>
      {{shopId}} - {{orderId}}
    </h1>
    <h2>
      {{numberOfCompletedOrderItems}}
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
  <div id="goToPaymentSm" class="card-footer text-muted fixed-bottom m-4">
    <router-link :to="{ name: 'checkout' }">
      <button type="button" disabled class="btn btn-primary btn-lg btn-block" style="width: 100%">Skomplemetowane</button>
    </router-link>
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
      numberOfAllOrderItems: 5,
      numberOfCompletedOrderItems: 0
    }
  },
  computed: {
    orderItems() {
      // console.log(this.$store.getters['orders/getOrderItems'])
      return this.$store.getters['orders/getOrderItems']
      // return ['s','s']
    },
    // orders() {
    //   // console.log(this.$store.getters['orders/getOrders'])
    //   return this.$store.getters['orders/getOrders']
    // },
    // orderIsImportant() {
    //   const order = this.$store.getters['orders/isImportant'];
    //   // return coaches.filter((coach) => {
    //   //   if (this.activeFilters.frontend && coach.areas.includes('frontend')) {
    //   //     return true;
    //   //   }
    //   //   if (this.activeFilters.backend && coach.areas.includes('backend')) {
    //   //     return true;
    //   //   }
    //   //   if (this.activeFilters.career && coach.areas.includes('career')) {
    //   //     return true;
    //   //   }
    //   //   return false;
    //   // });
    // },
  },
  methods: {
    async loadOrder() {
      try {
        // var shopId = this.shopId;
        console.log(this.orderId)
        parseInt(this.orderId);
        await this.$store.dispatch('orders/fetchOrderInfo', {
          shopId: this.shopId,
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
    }
  },
  created() {
    this.loadOrder();
  }
}
</script>


