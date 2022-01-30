<template>
  <div class="container-lg">
    <div class="row" style="margin-top: 25px">
      <div class="col-md-4 order-md-2 mb-4">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-muted">Twój koszyk</span>
          <span class="badge badge-secondary badge-pill">{{5}}</span>
        </h4>
        <ul class="list-group mb-3 col-auto">

          <li class="list-group-item d-flex justify-content-between lh-condensed"  v-for="productInCart in cartValue">
            <div>
              <h6 class="my-0">{{ productInCart.quantity }} x {{ productInCart.product.name }}</h6>
            </div>
            <span class="text-muted">{{ (productInCart.quantity*productInCart.price).toFixed(2) }}zł</span>
          </li>

          <li class="list-group-item d-flex justify-content-between">
            <strong>Suma</strong>
            <strong id="costForProducts">{{cartTotal}} zł</strong>
          </li>
        </ul>

      </div>

      <div class="col-md-8 order-md-1">
        <h4 class="mb-3">Dane do zamówienia</h4>


        <div class="mt-3">
          <div class="alert alert-primary row">
            <div class="col">1. Opcje dostawy</div>
            <div class="col-auto" v-show="step>2">
              <button type="button" class="btn btn-primary btn-block" @click="setStep(2)">
                Edytuj
              </button>
            </div>
          </div>
        </div>

        <div v-show="step===1">
          <shipping-address
              :shippingAddressInputs="shippingAddressInputs"
              @set-step="setStep"
          ></shipping-address>
        </div>


        <div v-show="step===2">
          <date-of-delivery
              :shippingAddressInputs="shippingAddressInputs"
              @set-date-id="setDate"
              @set-step="setStep"
          ></date-of-delivery>
        </div>

        <div class="mt-3">
          <div class="alert alert-primary row">
            <div class="col">2. Płatność</div>
            <div class="col-auto" v-show="step>3">
              <button type="button" class="btn btn-primary btn-block" @click="setStep(3)">
                Edytuj
              </button>
            </div>

          </div>
        </div>



        <div v-show="step===3">
          <payment-method
              @set-step="setStep"
          ></payment-method>
        </div>



        <div class="mt-3">
          <div class="alert alert-primary row">
            <div class="col">3. Podsumowanie</div>
          </div>
        </div>

        <div v-show="step===4">
          <div class="row">
            <div class="col-auto">
              <div>Miejsce dostawy: {{ shippingAddressInputs.town }} {{ shippingAddressInputs.address }}</div>
              <div>Data dostawy: {{deliveryDate.date}}</div>
              <div>Sposób płatności: gotówka</div>
              <div>Całkowita kwota do zapłaty: {{ cartTotal }} zł</div>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-auto">
              <div>
                Jeśli złożysz zamówienie faktura zostanie wysłana na Twój adres e-mail: {{shippingAddressInputs.email}}
              </div>
              <div>
                Kontunuacja oznacza zgodę naszego regulaminy.
              </div>
            </div>
          </div>
          <button type="button" class="btn btn-primary btn-lg btn-block mt-3" style="width: 100%" @click="submitOrder">
            Zamawiam i płacę
          </button>
        </div>


      </div>
    </div>
  </div>

</template>

<script>
import ShippingAddress from '../../components/layout/checkout/ShippingAddress'
import PaymentMethod from '../../components/layout/checkout/PaymentMethod'
import DateOfDelivery from "../../components/layout/checkout/DateOfDelivery";
export default {
  components: {DateOfDelivery, ShippingAddress, PaymentMethod},
  data() {
    return {
      step: 1,
      shippingAddressInputs: {
        name: '',
        surname: '',
        address: '',
        postcode: '',
        town: '',
        email: '',
        phoneNumber: ''
      },
      deliveryDate: {}
    }
  },
  computed: {
    cartValue() {
      return this.$store.getters['cart/cartItems']
    },
    cartTotal() {
      return this.$store.getters['cart/cartTotal'].toFixed(2)
    },
  },
  methods: {
    setStep(step) {
      this.step = step
    },
    setDate(date) {
      this.deliveryDate = date;
    },
    async submitOrder() {
      try {
        await this.$store.dispatch('orders/submitOrder', [
            this.shippingAddressInputs,
            this.deliveryDateId
          ])
      } catch (error) {
      }
    },
  }
}
</script>