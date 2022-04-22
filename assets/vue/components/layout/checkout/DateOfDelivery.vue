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

<!--    <form class="was-validated">-->
      <h5>Wybierz datę dostawy</h5>

    <div v-if="error.dateUnsetted.hasNotError===false" style="color: red">
      {{error.dateUnsetted.errorValue}}
    </div>

      <div v-for="date in dates">
        <div class="form-check">

          <input
              class="form-check-input"
              type="radio"
              name="dateDelivery"
              :id="date.date"
              :value="date"
              v-model="deliveryDate"
              @change="updatePickedDate"
              v-bind:class="{
            'is-valid':error.dateUnsetted.hasNotError,
            'is-invalid':error.dateUnsetted.hasNotError===false,
            'border-dark':!error.dateUnsetted.hasNotError
          }"
          />

          <label class="form-check-label" :for="date.date">
            {{ date.date }}
            <!--          {{ new Date() }}-->
          </label>
<!--          <div class="invalid-feedback">-->
<!--            {{error.dateUnsetted.errorValue}}-->
<!--          </div>-->
<!--          <div class="invalid-feedback">More example invalid feedback text</div>-->

          <!--        <div class="invalid-feedback">-->
          <!--          xd-->
          <!--        </div>-->
        </div>
      </div>
<!--    </form>-->


<!--    <h5 class="mt-4">Wybierz godzinę dostawy</h5>-->
<!--    <div class="form-check">-->
<!--      <input class="form-check-input" type="radio" v-model="deliveryHour" id="deliveryHours1"/>-->
<!--      <label class="form-check-label" for="deliveryHours1">-->
<!--        8:00-12:00-->
<!--      </label>-->
<!--    </div>-->
<!--    <div class="form-check">-->
<!--      <input class="form-check-input" type="radio" v-model="deliveryHour" id="deliveryHours2"/>-->
<!--      <label class="form-check-label" for="deliveryHours2">-->
<!--        12:00-16:00-->
<!--      </label>-->
<!--    </div>-->
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
      deliveryDate: null,
      deliveryHour: '',
      error: {
        dateUnsetted: {}
      }
    };
  },
  computed: {
    dates() {
      console.log(this.$store.getters['shop/getShopDatesAvailabilities'])
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
      if (this.deliveryDate) {
        this.error.dateUnsetted.hasNotError = true;
        this.$emit('set-step', 3);
      } else {
        this.error.dateUnsetted.hasNotError = false;
        this.error.dateUnsetted.errorValue = 'Wybierz datę';
      }
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
  watch: {
    deliveryDate(value) {
      if (value !== null) {
        this.error.dateUnsetted.hasNotError = true;

      }
    }
  },

  created() {
    this.downloadAvailabilityOrderDate()

  },
  // mounted() {
  //   console.log('xd')
  //
  //   console.log(this.$store.getters['shops/getShopDatesAvailabilities'])
  //   this.deliveryDate = this.dates[0]
  // }
}
</script>