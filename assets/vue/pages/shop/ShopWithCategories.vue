<template>
  <div className="container-lg" v-if="productsAreLoaded">
    <div v-if="userHasCartInShop === true">
      <div class="d-flex justify-content-between">
        <select-category
            :shopId="this.shopId"
        ></select-category>
        <div>
          <nav aria-label="...">
            <ul class="pagination">
              <li class="page-item" :class="{'disabled': paginationNumber===1}">
                <a class="page-link" @click="changePagination(-1)" href="#" tabindex="-1" aria-disabled="true">Poprzednie</a>
              </li>
              <li class="page-item" :class="{'disabled': paginationNumber === maxPaginationNumber}">
                <a class="page-link" @click="changePagination(1)" href="#">Następne</a>
              </li>
            </ul>
          </nav>
        </div>

      </div>

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
import SelectCategory from "../../components/layout/shop/SelectCategory";
export default {
  components: {SelectCategory, UserHasCartInOtherShop, Product},
  props: ['shopId', 'categoryName'],
  data() {
    return {
      productsAreLoaded: false,
      paginationNumber: 1,
      //TODO category
      // category: ''

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
    maxPaginationNumber() {
      return Math.ceil(this.$store.getters['products/numberOfProducts'] / 12)
    }
  },
  methods: {
    async loadProducts(pagination) {
      try {
        await this.$store.dispatch('products/loadProducts', {
          shopId: this.shopId,
          categoryName: this.categoryName,
          numberOfPagination: pagination
        })
      } catch (error) {
      }
      this.productsAreLoaded = true;
    },
    async loadNumberOfProductsInCategory() {
      try {
        await this.$store.dispatch('products/loadNumberOfProducts', {
          shopId: this.shopId,
          categoryName: this.category
        })
      } catch (error) {
      }
    },
    async loadCategories() {
      try {
        await this.$store.dispatch('products/loadCategories', {
          shopId: this.shopId,
        })
      } catch (error) {
      }
    },
    changePagination(value) {
      if (value === 1) {
        this.paginationNumber += 1;
        this.loadProducts(this.paginationNumber)
      } else if (value === -1) {
        this.paginationNumber -= 1;
        console.log(this.paginationNumber)
        this.loadProducts(this.paginationNumber)
      }
    }
  },
  created() {
    this.loadCategories();
    this.loadNumberOfProductsInCategory();
    this.loadProducts(1);
  },
}
</script>