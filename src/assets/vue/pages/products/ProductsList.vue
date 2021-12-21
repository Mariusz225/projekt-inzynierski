<template>
  <!--Section: Block Content-->
  <!--  <section>-->
  <div className="container-lg">

    <!-- Grid row -->
    <div className="row">

      <!-- Grid column -->
      <div className="col-md-4 col-lg-3 mb-4" v-for="product in products">

        <card-of-product
            :key="product.id"
            :id="product.id"
            :name="product.name"
            :product="product"
        ></card-of-product>

      </div>



    </div>
  </div>



</template>

<script>
import CardOfProduct from "../../components/layout/products/CardOfProduct";
export default {
  components: {CardOfProduct},
  props: ['shopId'],
  data() {
    return {
      // cartItems: []
    }
  },
  computed: {
    products() {
      return this.$store.getters['products/products']
    },
    productsInCart() {
      // console.log(this.$store.getters['cart/cartItems'])

      // this.$store.getters['cart/cartItems'].forEach( element => {
      //   console.log(element.orderItemId)
      //   // return element.orderItemId
      //   return element.orderItemId
      //     }
      //
      // )

      return this.$store.getters['cart/cartItems']
    },
    // quantityOfProductInCart() {
    //   return this.$store.getters['cart/quantityOfProductInCart']
    // },
    // productCartById() {
    //   return this.$store.getters['cart/getCartItemById(1)']
    // }
  },
  methods: {
    async loadProducts() {
      try {

        await this.$store.dispatch('products/loadProducts', {
          shopId: this.shopId
        })
      } catch (error) {

      }
    },
    // async downloadCartItems() {
    //   try {
    //     await this.$store.dispatch('cart/downloadCart')
    //   } catch (error) {
    //
    //   }
    //
    // }
  },
  created() {
    // this.downloadCartItems();
    this.loadProducts();
  },
}
</script>

<style scoped>
.img-product {
  width: 100%;
  /*height: 200px;*/
  object-fit: cover;
  aspect-ratio: 4/3;
}
</style>