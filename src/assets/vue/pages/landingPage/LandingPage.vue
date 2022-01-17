<template>
  <div class="container">
    <list-of-shops v-if="shopsAreFetched"></list-of-shops>
  </div>
</template>


<script>
import ListOfShops from "../../components/layout/landingPage/ListOfShops";
export default {
  name: 'App',
  components: {ListOfShops},
  computed: {
    shopsAreFetched() {
      return this.$store.getters['shops/areShopsFetched'];
    }
  },
  beforeCreate() {
    this.$store.dispatch('shops/fetchShops')
  },
}
</script>
