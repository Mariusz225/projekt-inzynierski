<!--<template>-->
<!--  &lt;!&ndash;Section: Block Content&ndash;&gt;-->
<!--&lt;!&ndash;  <section>&ndash;&gt;-->
<!--  <div class="container-lg">-->

<!--    &lt;!&ndash; Grid row &ndash;&gt;-->
<!--    <div class="row">-->

<!--      &lt;!&ndash; Grid column &ndash;&gt;-->
<!--      <div class="col-md-4 mb-4" v-for="product in products">-->

<!--        <div class="card p-2">-->

<!--          <img class="img-product"-->
<!--               src="https://picsum.photos/200" alt="Sample">-->

<!--          <button type="button" class="btn btn-primary btn-sm mr-1 mb-2"><i-->
<!--              class="fas fa-shopping-cart pr-2"></i>Dodaj do koszyka</button>-->

<!--          <div class="text-center pt-1">-->

<!--            <h5>[Company of Product]</h5>-->
<!--            <p class="mb-2 text-muted text-uppercase small">{{ product.name }}</p>-->
<!--            <hr>-->
<!--            <h6 class="mb-3">[12.99 $]</h6>-->
<!--          </div>-->
<!--        </div>-->
<!--      </div>-->

<!--    </div>-->
<!--  </div>-->

<!--&lt;!&ndash;  </section>&ndash;&gt;-->
<!--  &lt;!&ndash;Section: Block Content&ndash;&gt;-->
<!--</template>-->

<!--<script>-->
<!--export default {-->
<!--  props: ['shopId'],-->
<!--  computed: {-->
<!--    products() {-->
<!--      return this.$store.getters['products/products']-->
<!--    }-->
<!--  },-->
<!--  methods: {-->
<!--    async loadProducts() {-->
<!--      try {-->
<!--        await this.$store.dispatch('products/loadProducts', {-->
<!--          shopId: this.shopId-->
<!--        })-->
<!--      } catch (error) {-->

<!--      }-->
<!--    },-->
<!--    addToCart() {-->
<!--      -->
<!--    }-->
<!--  },-->
<!--  created() {-->
<!--    this.loadProducts()-->
<!--  },-->
<!--}-->
<!--</script>-->

<!--<style scoped>-->
<!--  .img-product {-->
<!--    width: 100%;-->
<!--    /*height: 200px;*/-->
<!--    object-fit: cover;-->
<!--    aspect-ratio: 4/3;-->
<!--  }-->
<!--</style>-->