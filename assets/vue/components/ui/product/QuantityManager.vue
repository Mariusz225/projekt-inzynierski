<template>
  <div class="row m-0 mb-2">
    <button class="btn btn-primary btn-sm col-4" @click="decrement">
      -
    </button>
    <input name="quantity" class="col-4" v-model="quantity" @keydown="checkIfInteger($event)" @blur="updateCart(quantity)" :min="0" step="any" type="number">
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
  watch: {
    quantity: function (val) {
      if (val > 12) {
        this.quantity = 12
      }
    }
  },
  methods: {
    async updateCart(quantity) {
      if (quantity > 12) {
        this.quantity = 12;
      } else if (quantity === '') {
        this.quantity = 0;
      } else {
        this.quantity = quantity
      }
      this.$store.dispatch('cart/updateCart', {
        productId: this.id,
        quantity: this.quantity,
        product: this.product,
      })
    },
    increment() {
      if (this.quantity >= 12) {
        this.updateCart(12)
      } else {
        this.quantity += 1;
        this.updateCart(this.quantity)
      }

    },
    decrement() {
      if (this.quantity === 0) {
        this.updateCart(0)
      } else {
        this.quantity -= 1;
        this.updateCart(this.quantity)
      }

    },
    checkIfInteger(e) {
      if (/^\W$/.test(e.key)) {
        e.preventDefault();
      }
    },
  }
}
</script>