<template>
  <div class="card p-2">
    <div>
      <div>Imię i nazwisko</div>
      <div>Adres</div>
      <div>Miejsowość kod</div>
      <div>e-mail</div>
      <div>numer telefonu</div>
    </div>
    <div>
      <button type="button" class="btn btn-primary btn-lg btn-block" style="width: 100%" @click="goBackToShippingAddresses">
        Wróć
      </button>
    </div>
  </div>

  <div class="mt-4">
    <h5>Wybierz datę dostawy</h5>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked>
      <label class="form-check-label" for="flexRadioDefault1">
        Dostawa 1
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
      <label class="form-check-label" for="flexRadioDefault2">
        Dostawa 2
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
      <label class="form-check-label" for="flexRadioDefault2">
        Dostawa 3
      </label>
    </div>
  </div>

  <button type="button" class="btn btn-primary btn-lg btn-block" style="width: 100%" @click="goToPaymentMethod">
    Przejdź do płatności
  </button>
</template>

<script>
export default {
  props: {},
  emits: ['set-step'],
  methods: {
    goBackToShippingAddresses() {
      this.$emit('set-step', 1);
    },
    goToPaymentMethod() {
      this.$emit('set-step', 3);
    }
  }
}
</script>