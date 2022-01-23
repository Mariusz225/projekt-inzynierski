<template>
  <!--Section: Block Content-->
  <!--  <section>-->
  <div className="container-lg" v-if="productsAreLoaded">
    <div v-if="userHasCartInOtherShop === true">
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
    <div v-else>
      masz koszyk w innym sklepie
    </div>


    <!-- Grid row -->

  </div>



</template>

<script>
import CardOfProduct from "../../components/layout/products/CardOfProduct";
export default {
  components: {CardOfProduct},
  props: ['shopId'],
  data() {
    return {
      productsAreLoaded: false
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
    // },
    viewedShop() {
      // console.log(this.$store.getters['cart/getShopId'])
      // console.log(this.shopId)
      return this.$store.getters['cart/getShopId']
    },
    userHasCartInOtherShop() {
      // console.log(this.$store.getters['cart/getShopId']);
      if (this.$store.getters['cart/getShopId'] !== undefined) {
        console.log(parseInt(this.shopId) === this.$store.getters['cart/getShopId'])
        return parseInt(this.shopId) === this.$store.getters['cart/getShopId']
      }
    },
  },
  methods: {
    async loadProducts() {

      try {
        await this.$store.dispatch('products/loadProducts', {
          shopId: this.shopId
        })
      } catch (error) {
      }
      this.productsAreLoaded = true;
    },
    // async setViewedShop() {
    //   try {
    //     await this.$store.dispatch('cart/setViewedShop', {
    //       shopId: this.shopId
    //     })
    //   } catch (error) {
    //
    //   }
    // }
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
    var shopId = this.$store.getters['cart/getShopId']
    if (this.shopId === shopId) {
      console.log('sss')
    }
    // console.log(shopId)
    // this.setViewedShop();
    this.loadProducts();
  },
  mounted() {
    // this.setViewedShop();
  }
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