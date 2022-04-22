<template>
  <div class="row">
    <div class="col-md-6 mb-3">
      <label for="firstname">Imię</label>
      <input
          type="text"
          class="form-control"
          id="firstname"
          placeholder="Imię"
          required
          @blur="validateInputName"
          v-model="shippingAddressInputs.name"
          v-bind:class="{
            'is-valid':error.name.hasNotError,
            'is-invalid':error.name.hasNotError===false,
            'border-dark':!error.name.hasNotError
          }"
      >
      <div class="invalid-feedback">
        {{error.name.errorValue}}
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <label for="surname">Nazwisko</label>
      <input
          type="text"
          class="form-control"
          id="surname" placeholder="Nazwisko"
          required
          @blur="validateInputSurname"
          v-model="shippingAddressInputs.surname"
          v-bind:class="{
            'is-valid':error.surname.hasNotError,
            'is-invalid':error.surname.hasNotError===false,
            'border-dark':!error.surname.hasNotError
          }"
      >
      <div class="invalid-feedback">
        {{error.surname.errorValue}}
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12 mb-3">
      <label for="street">Adres</label>
      <input
          type="text"
          class="form-control"
          id="street"
          placeholder="Adres"
          required
          @blur="validateInputAddress"
          v-model="shippingAddressInputs.address"
          v-bind:class="{
            'is-valid':error.address.hasNotError,
            'is-invalid':error.address.hasNotError===false,
            'border-dark':!error.address.hasNotError
          }"
      >
      <div class="invalid-feedback">
        {{error.address.errorValue}}
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-4 mb-3">
      <label for="postcode">Kod pocztowy</label>
      <input
          type="text"
          class="form-control"
          id="postcode"
          placeholder="Kod pocztowy"
          required
          @blur="validateInputPostcode"
          v-model="shippingAddressInputs.postcode"
          v-bind:class="{
            'is-valid':error.postcode.hasNotError,
            'is-invalid':error.postcode.hasNotError===false,
            'border-dark':!error.postcode.hasNotError
          }"
      >
      <div class="invalid-feedback">
        {{ error.postcode.errorValue }}
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <label for="town">Miejscowość</label>
      <input
          type="text"
          class="form-control"
          id="town"
          placeholder="Miejscowość"
          required
          @blur="validateInputTown"
          v-model="shippingAddressInputs.town"
          v-bind:class="{
            'is-valid':error.town.hasNotError,
            'is-invalid':error.town.hasNotError===false,
            'border-dark':!error.town.hasNotError
          }"
      >
      <div class="invalid-feedback">
        {{ error.town.errorValue }}
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
      <input
          type="text"
          class="form-control"
          id="email"
          placeholder="E-mail"
          required
          @blur="validateInputEmail"
          v-model="shippingAddressInputs.email"
          v-bind:class="{
            'is-valid':error.email.hasNotError,
            'is-invalid':error.email.hasNotError===false,
            'border-dark':!error.email.hasNotError
          }"
      >
      <div class="invalid-feedback">
        {{ error.email.errorValue }}
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <label for="phoneNumber">Numer telefonu</label>
      <input
          type="text"
          class="form-control"
          id="phoneNumber"
          placeholder="Numer telefonu"
          required
          @blur="validateInputPhoneNumber"
          v-model="shippingAddressInputs.phoneNumber"
          v-bind:class="{
            'is-valid':error.phoneNumber.hasNotError,
            'is-invalid':error.phoneNumber.hasNotError===false,
            'border-dark':!error.phoneNumber.hasNotError
          }"
      >
      <div class="invalid-feedback">
        {{ error.phoneNumber.errorValue }}
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
  data() {
    return {
      errorMessages: {
        notNull: 'Te pole nie może być puste',
        email: 'Wpisz poprawny adres e-mail',
        phoneNumber: 'Wpisz poprawny numer telefonu',
      },
      error: {
        name: {},
        surname: {},
        address: {},
        postcode: {},
        town: {},
        email: {},
        phoneNumber: {}
      },
    }
  },
  methods: {
    validateInputName() {
      if (this.shippingAddressInputs.name === '') {
        this.error.name.hasNotError = false;
        this.error.name.errorValue = this.errorMessages.notNull;
      } else {
        this.error.name.hasNotError = true;
        return true
      }
      return false
    },
    validateInputSurname() {
      if (this.shippingAddressInputs.surname === '') {
        this.error.surname.hasNotError = false;
        this.error.surname.errorValue = this.errorMessages.notNull;
      } else this.error.surname.hasNotError = true
    },
    validateInputAddress() {
      if (this.shippingAddressInputs.address === '') {
        this.error.address.hasNotError = false;
        this.error.address.errorValue = this.errorMessages.notNull;
      } else this.error.address.hasNotError = true
    },
    validateInputPostcode() {
      if (this.shippingAddressInputs.postcode === '') {
        this.error.postcode.hasNotError = false;
        this.error.postcode.errorValue = this.errorMessages.notNull;
      } else this.error.postcode.hasNotError = true
    },
    validateInputTown() {
      if (this.shippingAddressInputs.town === '') {
        this.error.town.hasNotError = false;
        this.error.town.errorValue = this.errorMessages.notNull;
      } else this.error.town.hasNotError = true
    },
    validateInputEmail() {
      if (this.shippingAddressInputs.email === '') {
        this.error.email.hasNotError = false;
        this.error.email.errorValue = this.errorMessages.notNull;
      } else if (/\S+@\S+\.\S+/.test(this.shippingAddressInputs.email) === false) {
        this.error.email.hasNotError = false;
        this.error.email.errorValue = this.errorMessages.email;
      } else this.error.email.hasNotError = true

    },
    validateInputPhoneNumber() {
      if (this.shippingAddressInputs.phoneNumber === '') {
        this.error.phoneNumber.hasNotError = false;
        this.error.phoneNumber.errorValue = this.errorMessages.notNull;
      } else if (!/^\d+$/.test(this.shippingAddressInputs.phoneNumber)) {
        this.error.phoneNumber.hasNotError = false;
        this.error.phoneNumber.errorValue = this.errorMessages.phoneNumber;
      } else if(this.shippingAddressInputs.phoneNumber === '') {

      } else this.error.phoneNumber.hasNotError = true
    },
    submitForm() {
      this.validateInputName();
      this.validateInputSurname();
      this.validateInputAddress();
      this.validateInputPostcode();
      this.validateInputTown();
      this.validateInputEmail();
      this.validateInputPhoneNumber();

      if (
          this.error.name.hasNotError
          && this.error.surname.hasNotError
          && this.error.address.hasNotError
          && this.error.postcode.hasNotError
          && this.error.town.hasNotError
          && this.error.email.hasNotError
          && this.error.phoneNumber.hasNotError
      ) {
        this.$emit('set-step', 2);
      }
    }
  }
}
</script>