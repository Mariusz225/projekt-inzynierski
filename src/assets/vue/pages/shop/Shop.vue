<template>
  <div className="container-lg" v-if="productsAreLoaded">
    <div v-if="userHasCartInShop === true">
      <div className="row">
        <div className="col-md-4 col-lg-3 mb-4" v-for="product in products">

          <product
              :key="product.id"
              :id="product.id"
              :shopId="this.shopId"
              :name="product.name"
              :product="product"
          ></product>

        </div>
      </div>
    </div>

    <div v-else>
      <user-has-cart-in-other-shop
          :shopId="shopWhereIsCart"
      ></user-has-cart-in-other-shop>
    </div>

  </div>
</template>

<script>
import Product from "../../components/layout/shop/Product";
import UserHasCartInOtherShop from "../../components/layout/products/UserHasCartInOtherShop";
export default {
  components: {UserHasCartInOtherShop, Product},
  props: ['shopId'],
  data() {
    return {
      productsAreLoaded: false,
    }
  },
  computed: {
    products() {
      return this.$store.getters['products/products']
    },
    shopWhereIsCart() {
      return this.$store.getters['cart/getShopId']
    },
    userHasCartInShop() {
      if (this.$store.getters['cart/getShopId'] !== undefined) {
        //TODO bug
        return parseInt(this.shopId) === this.$store.getters['cart/getShopId']
        || this.shopId === this.$store.getters['cart/getShopId']
      } else if (this.$store.getters['cart/getShopId'] === undefined) {
        return true;
      }

    },
  },
  methods: {
    async loadProducts() {
      try {
        await this.$store.dispatch('products/loadProducts', {
          shopId: this.shopId,
          numberOfPagination: 1
        })
      } catch (error) {
      }
      this.productsAreLoaded = true;
    },
  },
  created() {
    this.loadProducts();
  },
}
</script>