<template>
  <div v-if="ordersAreLoaded && isCheckedThatUserHasStartedOrder">
    <div v-if="userHasStartedOrder">
      <div class="card">
        <div class="card-body d-flex">
          <router-link class="me-auto p-2 d-flex" :to="{name: 'completingTheOrder', params: {orderId: userHasStartedOrder}}">
            <div class="btn">

              <div class="m-auto">
                <div class="fw-bold">
                  Masz już zaczęte zamówienie - wróć do niego
                </div>
              </div>
            </div>
          </router-link>

          <button class="p-2 btn btn-secondary" @click="cancelCompletingOrder">
            Anuluj
          </button>

        </div>
      </div>
    </div>
    <div class="card" v-for="order in orders">
<!--      {{ order }}-->
      <order
          :key="order.id"
          :order="order"
      ></order>
    </div>
  </div>
  <div v-else>
    Ładowanie
  </div>

</template>

<script>
import Order from "../../components/layout/shopkeeper/Order";
export default {
  components: {Order},
  props: ['shopId'],
  data() {
    return {
      ordersAreLoaded: false,
      isCheckedThatUserHasStartedOrder: false
    }
  },
  computed: {
    orders() {
      return this.$store.getters['orders/getOrders'];
    },
    userHasStartedOrder() {
      if (this.$store.getters['employee/getStartedOrder'] !== false) {
        // console.log(this.$store.getters['shopService/getStartedOrder'])
        return this.$store.getters['employee/getStartedOrder']
      }
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
      this.ordersAreLoaded = true
    },
    async checkIfShopkeeperHasStartedOrder() {
      try {
        await this.$store.dispatch('employee/checkIfShopkeeperHasStartedOrder')
      } catch (error) {
      }
      this.isCheckedThatUserHasStartedOrder = true
    },
    //TODO
    async cancelCompletingOrder() {
      try {
        await this.$store.dispatch('employee/cancelCompletingOrder')
      } catch (error) {
      }
    },
  },
  created() {
    //TODO error kiedy cofa się stronę (chyba już nie ma)

    this.checkIfShopkeeperHasStartedOrder();
    this.loadOrders();
  }
}
</script>