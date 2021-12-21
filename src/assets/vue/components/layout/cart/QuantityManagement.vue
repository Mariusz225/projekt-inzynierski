<template>
  <div class="row m-0 mb-2">
    <button class="btn btn-primary btn-sm col-4" @click="decrement">
      -
    </button>
    <input name="quantity" class="col-4" min="0" type="number" v-model="quantity">
    <button class="btn btn-primary btn-sm col-4" @click="increment">
      +
    </button>
  </div>
</template>

<script>
export default {
  props:['quantityValue', 'id', 'product'],
  data() {
    return {
      quantity: this.quantityValue,
    }
  },
  computed: {
    // quantityValue() {
    //   console.log(this.quantity)
    //   return this.quantity
    // }
  },
  methods: {
    async updateCart() {
      this.$store.dispatch('cart/updateCart', {
        productId: this.id,
        quantity: this.quantity,
        product: this.product,
      })
    },
    increment() {
      this.quantity += 1;
      this.updateCart(this.quantity)
    },
    decrement() {
      if (this.quantity === 0) {
        return
      }
      this.quantity -= 1;
      this.updateCart(this.quantity)
    },
  }
}
</script>