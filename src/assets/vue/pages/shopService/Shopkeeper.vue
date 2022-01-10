<template>
  <div class="card">
    <div>
      <div class="card-body d-flex">
        <div class="me-auto p-2">
          Zamówienie 1
        </div>
        <div class="p-2">
          Komplemetuj
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['shopId'],
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
    this.loadOrders();
  }
}
</script>