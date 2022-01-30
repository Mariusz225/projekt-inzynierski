<template>
  <div class="container">
    <list-of-shops v-if="shopsAreLoaded"></list-of-shops>
  </div>
</template>


<script>
import ListOfShops from "../../components/layout/landingPage/ListOfShops";
export default {
  name: 'App',
  components: {ListOfShops},
  data() {
    return {
      shopsAreLoaded: false
    }
  },
  computed: {
    // shopsAreFetched() {
    //   return this.$store.getters['shop/areShopsFetched'];
    // }
  },
  methods: {
    async fetchShops() {
      await this.$store.dispatch('shops/fetchShops');
      this.shopsAreLoaded = true;
    }
  },
  created() {
    this.fetchShops();
  },
}
</script>
