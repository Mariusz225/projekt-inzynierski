<template>
  <div class="container-xl">
    <div class="row">
      <div class="col-md-4 col-lg-3">
        <section>
          <filter-shops @change-filter="setFilters"></filter-shops>
        </section>
      </div>
      <div class="col-md-8 col-lg-9">
        <section>
          <div v-for="shop in filteredShops">
<!--            {{shop.name}}-->
            <div class="card p-3 m-1">


                <img src="data:image/png;base64,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" alt="..." class="img-thumbnail" style="max-width: 150px">

              nazwa sklepu: {{shop.name}}<br>
              minimalna kwota: {{shop.order.minimumCost}}<br>
              dostawa: {{shop.order.deliveryCost}}<br>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
</template>
<script>
import FilterShops from "../../components/layout/shops/FilterShops";
import SelectedShops from "../../components/layout/shops/SelectedShops";
export default {
  components: {
    SelectedShops,
    FilterShops
  },
  data() {
    return {
      activeFilters: {
        deliveryOrPickup: 'delivery',
        minimumCost: 'allMinimumCost',
        minimumDeliveryCost: 'allMinimumDeliveryCost'
      },
    }
  },
  computed: {
    filteredShops() {
      const shops = this.$store.getters['shops/shops'];

      let word = this.activeFilters.minimumCost;
      let n = 0;
      let minimumCost = ''
      while (word.charAt(n) >= '0' && word.charAt(n) <= '9') {
        minimumCost += word.charAt(n)
        n++
      }

      word = this.activeFilters.minimumDeliveryCost;
      n = 0;
      let minimumDeliveryCost = ''
      while (word.charAt(n) >= '0' && word.charAt(n) <= '9') {
        minimumDeliveryCost += word.charAt(n)
        n++
      }

      return shops.filter((shop) => {
        return (this.activeFilters.deliveryOrPickup === 'delivery' && shop.order.isPossibleDelivery === true
                || this.activeFilters.deliveryOrPickup === 'pickup' && shop.order.isPossiblePickup === true)
            && (minimumCost >= shop.order.minimumCost || minimumCost === '')
            && (minimumDeliveryCost >= shop.order.deliveryCost || minimumDeliveryCost === '' || this.activeFilters.deliveryOrPickup === 'pickup');

      })

    }
  },
  methods: {
    setFilters(updatedFilters) {
      this.activeFilters = updatedFilters;
    },
    loadShops() {

    }
  }
}
</script>