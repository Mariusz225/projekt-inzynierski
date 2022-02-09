<template>
  <div id="v-model-select" class="demo">
    <select class="form-select" v-model="selected">
      <option value="">Wybierz kategorie</option>
<!--      <router-link :to="{name: 'categoryInShop', params: {categoryName: this.selected}}">-->
<!--        -->
<!--      </router-link>-->
      <option @click="xd">Wszystko</option>
      <option @click="" v-for="category in categories">{{category.name}}</option>
    </select>
<!--    <span>Selected: {{ selected }}</span>-->
  </div>
</template>

<script>
import router from "../../../router";

export default {
  data() {
    return {
      selected: ''
    }
  },
  props: ['shopId'],
  computed: {
    categories() {
      return this.$store.getters['products/categories'];
    }
  },
  watch: {
    selected() {
      // console.log(this.$route.params.shopId)
      if (this.selected === 'Wszystko') {
        router.push({ name: 'shop', params: {shopId: this.$route.params.shopId}})
      } else {
        router.push({ name: 'categoryInShop', params: {shopId: this.$route.params.shopId, categoryName: this.selected}})
      }

      this.updateProducts();
    }
  },
  methods: {
    async updateProducts() {
      try {
        await this.$store.dispatch('products/loadProducts', {
          shopId: this.shopId,
          categoryName: this.selected,
          numberOfPagination: 1
        })
      } catch (error) {
      }
      this.productsAreLoaded = true;
      console.log('ss')
    },
  }
}
</script>