<template>

  <div class="row">

    <div class="input-group mb-3">
      <input type="text" class="form-control" placeholder="Kod pocztowy">
      <div class="input-group-append">
        <button class="btn btn-outline-secondary" type="button">Button</button>
        <button class="btn btn-outline-secondary" type="button">Button</button>
      </div>
    </div>

    <div class="input-group mb-3">
      <input type="radio" class="btn-check" name="deliveryOrPickup" id="delivery" autocomplete="off" value="delivery" checked @change="setFilter">
      <label class="btn btn-outline-secondary col-6" for="delivery">Dostawa</label>

      <input type="radio" class="btn-check" name="deliveryOrPickup" id="pickup" autocomplete="off" value="pickup" @change="setFilter">
      <label class="btn btn-outline-secondary col-6" for="pickup">Odbiór</label>
    </div>

    <div>
      <p class="h5 mt-3 mb-0 m-auto">Minimalna kwota zamówienia</p>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="minimumCost" id="allMinimumCost" checked @change="setFilter">
        <label class="form-check-label" for="allMinimumCost">
          Pokaż wszystkie
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="minimumCost" id="30minimumCost" @change="setFilter">
        <label class="form-check-label" for="30minimumCost">
          30.00 zł lub mniej
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="minimumCost" id="50minimumCost" @change="setFilter">
        <label class="form-check-label" for="50minimumCost">
          50.00 zł lub mniej
        </label>
      </div>
    </div>

    <div v-show="filters.deliveryOrPickup === 'delivery'">
      <p class="h5 mt-3 mb-0">Koszt dostawy</p>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="minimumDeliveryCost" id="allMinimumDeliveryCost" checked @change="setFilter">
        <label class="form-check-label" for="allMinimumDeliveryCost">
          Pokaż wszystkie
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="minimumDeliveryCost" id="10minimumDeliveryCost" @change="setFilter">
        <label class="form-check-label" for="10minimumDeliveryCost">
          10.00 zł lub mniej
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="minimumDeliveryCost" id="15minimumDeliveryCost" @change="setFilter">
        <label class="form-check-label" for="15minimumDeliveryCost">
          15.00 zł lub mniej
        </label>
      </div>
    </div>


  </div>

</template>

<script>
export default {
  emits: ['change-filter'],
  data() {
    return {
      filters: {
        deliveryOrPickup: 'delivery',
        minimumCost: 'allMinimumCost',
        minimumDeliveryCost: 'allMinimumDeliveryCost',


      },
      // deliveryOrPickup: null
    };
  },
  methods: {
    setFilter(event) {
      const inputName = event.target.name;
      const inputId = event.target.id;


      const updatedFilters = {
        ...this.filters,
        [inputName]: inputId
      };

      this.filters = updatedFilters;

      this.$emit('change-filter', updatedFilters);
    },
  }
}
</script>