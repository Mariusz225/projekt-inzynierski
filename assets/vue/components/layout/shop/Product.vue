<template>
  <div className="card p-2">

    <img class="img-product"
         src="https://picsum.photos/200" alt="Sample">

    <div v-if="!isInCart">
      <button type="button" className="btn btn-primary btn-sm mr-1 mb-2 w-100 h-100" @click="updateCart(1)"><i
          className="fas fa-shopping-cart pr-2"></i>Dodaj do koszyka
      </button>
    </div>
    <quantity-manager
        v-else
        :id="id"
        :quantity-value="quantity"
        :product="product"
    ></quantity-manager>

    <div className="text-center pt-1">

      <h5>{{ name }}</h5>
<!--      <p className="mb-2 text-muted text-uppercase small">{{ name }}</p>-->
      <hr>
      <h6 className="mb-3">{{ product.price }} zł</h6>
    </div>
  </div>

</template>

<script>
import QuantityManager from "../../ui/product/QuantityManager";
export default {
  components: {QuantityManager},
  props: ['id', 'shopId', 'name', 'product'],
  data() {
    return {
      productInfo: null,
      quantity: 0,
    }
  },
  watch: {
    quantity: function (val) {
      if (val > 12) {
        this.quantity = 12
      }
    }
  },
  computed: {
    cartValue() {
      return this.$store.getters['cart/cartItems']
    },
    isInCart() {
      let json = this.$store.getters['cart/getCartItemById'](this.id);
      return json !== undefined;
    },
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
        shopId: this.shopId,
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
    quantityInCart() {
      let json = this.$store.getters['cart/getCartItemById'](this.id);
      if (json) {
        return this.quantity = json.quantity
      } else {
        return false
      }
    },
  },
  created() {
    this.quantityInCart()
  }
}
</script>