<template>
  <div className="card p-2">

    <img class="img-product"
         src="https://picsum.photos/200" alt="Sample">

    <div v-if="!isInCart">
      <button type="button" className="btn btn-primary btn-sm mr-1 mb-2 w-100 h-100" @click="updateCart(1)"><i
          className="fas fa-shopping-cart pr-2"></i>Dodaj do koszyka
      </button>
    </div>
    <div v-else class="row m-0 mb-2">
      <button class="btn btn-primary btn-sm col-4" @click="decrement">
        -
      </button>
      <input name="quantity" class="col-4" v-model="quantity" min="0" type="number">
      <button class="btn btn-primary btn-sm col-4" @click="increment">
        +
      </button>
    </div>




    <div className="text-center pt-1">

      <h5>[Company of Product]</h5>
      <p className="mb-2 text-muted text-uppercase small">{{ name }}</p>
      <hr>
      <h6 className="mb-3">{{ product.price }} zł</h6>
    </div>
  </div>
<!--  <div v-for="x in cart">-->
<!--    <h1>sss</h1>-->
<!--  </div>-->

</template>

<script>
export default {
  props: ['id', 'name', 'product'],
  data() {
    return {
      productInfo: null,
      quantity: 0,
    }
  },
  computed: {
    cartValue() {
      // console.log(this.productsInCart[0])

      // console.log(this.id)
      // if (this.isInCart) {
      //   console.log('sss')
      // }
      // console.log(this.$store.getters['cart/cartItems'])


      // if ()


      // console.log(this.$store.getters['cart/cartItems'][0])
      // console.log(this.$store.getters['cart/cartItems'][1])
      // console.log(this.$store.getters['cart/cartItems'][2])

      // console.log(this.productsInCart)
      // console.log(this.$store.getters['cart/cartItems'])
      // console.log(this.$store.getters['cart/cartItems'][0].orderItemId)
      return this.$store.getters['cart/cartItems']
    },
    isInCart() {
      // console.log(this.$store.getters['cart/getCartItemById'](this.id))
      let json = this.$store.getters['cart/getCartItemById'](this.id);
      // this.quantity = 1
      return json !== undefined;


    },
    // quantity() {
    //   console.log(this.$store.getters['cart/getCartItemById'](this.id)) ;
    //   return this.$store.getters['cart/getCartItemById'](this.id);
    // }
  },
  methods: {
    async updateCart(quantity) {
      this.quantity = quantity
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
    quantityInCart() {
      // console.log(this.$store.getters['cart/getCartItemById'](this.id))
      let json = this.$store.getters['cart/getCartItemById'](this.id);
      // this.quantity = 1
      // return json !== undefined;
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