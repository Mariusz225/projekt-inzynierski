<template>
  <div class="card p-2">
      <div class="row">
        <div class="col-auto">
          <div>{{ shippingAddressInputs.name }} {{ shippingAddressInputs.surname }}</div>
          <div>{{ shippingAddressInputs.address }}</div>
          <div>{{ shippingAddressInputs.town }} {{ shippingAddressInputs.postcode }}</div>
          <div>{{ shippingAddressInputs.email }}</div>
          <div>{{ shippingAddressInputs.phoneNumber }}</div>
        </div>
        <div class="col">
          <div class="float-end">
<!--            <button type="button" class="btn btn-primary btn-lg btn-block"  @click="goBackToShippingAddresses">-->
<!--              Wróć-->
<!--            </button>-->
            <font-awesome-icon :icon="['fas', 'edit']" class="fa-4x" @click="goBackToShippingAddresses"></font-awesome-icon>
          </div>
        </div>



      </div>
    </div>


  <div class="mt-4">
    <h5>Wybierz datę dostawy</h5>
    <div v-for="date in dates">
      <div class="form-check">
        <input class="form-check-input" type="radio" name="dateDelivery" :id="date.date" :value="date" v-model="deliveryDate" @change="updatePickedDate" />
        <label class="form-check-label" :for="date.date">
          {{ date.date }}
<!--          {{ new Date() }}-->
        </label>
      </div>
    </div>
  </div>



  <button type="button" class="btn btn-primary btn-lg btn-block" style="width: 100%" @click="goToPaymentMethod">
    Przejdź do płatności
  </button>
</template>

<script>
export default {
  props: {
    shippingAddressInputs: {
      type: Object,
      required: true
    },
  },
  emits: ['set-step', 'set-date-id'],
  data() {
    return {
      deliveryDate: null
    };
  },
  computed: {
    dates() {
      // console.log(this.$store.getters['shops/getShopDatesAvailabilities'].setHours(0,0,0,0))
      // console.log(this.dateId)
      return this.$store.getters['shops/getShopDatesAvailabilities'];
    },
    // picked() {
    //   console.log()
    // }
  },
  methods: {
    goBackToShippingAddresses() {
      this.$emit('set-step', 1);
    },
    goToPaymentMethod() {
      this.$emit('set-step', 3);
    },
    async downloadAvailabilityOrderDate() {
      try {
        await this.$store.dispatch('shops/fetchAvailabilityOrderDate')
      } catch (error) {
      }
    },
    updatePickedDate() {
      this.$emit('set-date-id', this.deliveryDate)
    }
  },
  created() {
    this.downloadAvailabilityOrderDate()
  }
}
</script>