<template>
  <!--Section: Block Content-->
  <!--  <section>-->
  <div className="container-lg" v-if="productsAreLoaded">
    <div v-if="userHasCartInShop === true">
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
      <user-has-cart-in-other-shop
          :shopId="viewedShop"
      ></user-has-cart-in-other-shop>
    </div>


    <!-- Grid row -->

  </div>



</template>

<script>
import CardOfProduct from "../../components/layout/products/CardOfProduct";
import UserHasCartInOtherShop from "../../components/layout/products/UserHasCartInOtherShop";
export default {
  components: {UserHasCartInOtherShop, CardOfProduct},
  props: ['shopId'],
  data() {
    return {
      productsAreLoaded: true
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
      return this.$store.getters['cart/getShopId']
    },
    userHasCartInShop() {
      console.log(this.$store.getters['cart/getShopId'])
      if (this.$store.getters['cart/getShopId'] === null) {
        return true
      }
      if (this.$store.getters['cart/getShopId'] !== undefined) {
        return parseInt(this.shopId) === this.$store.getters['cart/getShopId']
      } else if (this.$store.getters['cart/getShopId'] === undefined) {
        return true;
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