<template>
  <div class="row">
    <div class="col-md-6 mb-3">
      <label for="firstname">Imię</label>
      <input type="text" class="form-control is-valid" id="firstname" placeholder="Imię" required @blur="validateInput" v-model="shippingAddressInputs.name.value">
    </div>
    <div class="col-md-6 mb-3">
      <label for="surname">Nazwisko</label>
      <input type="text" class="form-control is-valid" id="surname" placeholder="Nazwisko" required @blur="validateInput" v-model="shippingAddressInputs.surname.value">
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12 mb-3">
      <label for="street">Adres</label>
      <input type="text" class="form-control is-valid" id="street" placeholder="Adres" required>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-4 mb-3">
      <label for="postcode">Kod pocztowy</label>
      <input type="text" class="form-control is-valid" id="postcode" placeholder="Kod pocztowy" required>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <label for="town">Miejscowość</label>
      <input type="text" class="form-control is-valid" id="town" placeholder="Miejscowość" required>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <fieldset disabled>
        <label for="city">Kraj</label>
        <input type="text" class="form-control" id="city" placeholder="Polska" required>
      </fieldset>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6 mb-3">
      <label for="email">E-mail</label>
      <input type="text" class="form-control is-valid" id="email" placeholder="E-mail" required>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <label for="phoneNumber">Numer telefonu</label>
      <input type="text" class="form-control is-valid" id="phoneNumber" placeholder="Numer telefonu" required>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
  </div>

  <button type="button" class="btn btn-primary btn-lg btn-block" style="width: 100%" @click="submitForm">
    Zapisz i kontynuuj
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
  emits: ["set-step"],
  methods: {
    validateInput() {
      //name
      if (this.shippingAddressInputs.name.value === '') {
        this.shippingAddressInputs.name.correct = false;
      } else this.shippingAddressInputs.name.correct = true

      //surname
      if (this.shippingAddressInputs.name.value === '') {
        this.shippingAddressInputs.name.correct = false
      } else this.shippingAddressInputs.name.correct = true

      //street
      if (this.shippingAddressInputs.name.value === '') {
        this.shippingAddressInputs.name.correct = false
      } else this.shippingAddressInputs.name.correct = true

      //postcode
      if (this.shippingAddressInputs.name.value === '') {
        this.shippingAddressInputs.name.correct = false
      } else this.shippingAddressInputs.name.correct = true

      //town
      if (this.shippingAddressInputs.name.value === '') {
        this.shippingAddressInputs.name.correct = false
      } else this.shippingAddressInputs.name.correct = true

      //email
      if (this.shippingAddressInputs.name.value === '') {
        this.shippingAddressInputs.name.correct = false
      } else this.shippingAddressInputs.name.correct = true

      //phoneNumber
      if (this.shippingAddressInputs.name.value === '') {
        this.shippingAddressInputs.name.correct = false
      } else this.shippingAddressInputs.name.correct = true

    },
    submitForm() {
      this.validateInput();
      this.$emit('set-step', 2);
    }
  }
}
</script>