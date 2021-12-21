<template>
  <div class="container-lg">
    <div class="row" style="margin-top: 25px">
      <div class="col-md-4 order-md-2 mb-4">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-muted">Twój koszyk</span>
          <span class="badge badge-secondary badge-pill">{{5}}</span>
        </h4>
        <ul class="list-group mb-3 col-auto">

          <li class="list-group-item d-flex justify-content-between lh-condensed">
            <div>
              <h6 class="my-0">2 x 4</h6>
            </div>
            <span class="text-muted">{{ 2*3 }}zł</span>
          </li>

          <li class="list-group-item d-flex justify-content-between">
            <strong>Suma</strong>
            <strong id="costForProducts"></strong>
          </li>
        </ul>

      </div>

      <div class="col-md-8 order-md-1">
        <h4 class="mb-3">Dane do zamówienia</h4>
<!--        <form>-->

        <div class="mt-3">
          <!--          <div class="card">wróć</div>-->
          <div class="alert alert-primary row">
            <div class="col">1. Opcje dostawy</div>
            <div class="col-auto" v-if="step>2">
              <button type="button" class="btn btn-primary btn-block" @click="setStep(2)">
                Edytuj
              </button>
            </div>

          </div>
        </div>
        <div v-show="step===1">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="firstname">Imię</label>
              <input type="text" class="form-control is-valid" id="firstname" placeholder="Imię" required>
              <div class="valid-feedback">
                Looks good!
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <label for="surname">Nazwisko</label>
              <input type="text" class="form-control is-valid" id="surname" placeholder="Nazwisko" required>
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

          <button type="button" class="btn btn-primary btn-lg btn-block" style="width: 100%" @click="setStep(2)">
            Zapisz i kontynuuj
          </button>
        </div>




        <div v-if="step===2">
          <div class="card p-2">
            <div>
              <div>Imię i nazwisko</div>
              <div>Adres</div>
              <div>Miejsowość kod</div>
              <div>e-mail</div>
              <div>numer telefonu</div>
            </div>
            <div>
              <button type="button" class="btn btn-primary btn-lg btn-block" style="width: 100%" @click="setStep(1)">
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

          <button type="button" class="btn btn-primary btn-lg btn-block" style="width: 100%" @click="setStep(3)">
            Przejdź do płatności
          </button>

        </div>

        <div class="mt-3">
          <!--          <div class="card">wróć</div>-->
          <div class="alert alert-primary row">
            <div class="col">2. Płatność</div>
            <div class="col-auto" v-if="step>3">
              <button type="button" class="btn btn-primary btn-block" @click="setStep(3)">
                Edytuj
              </button>
            </div>

          </div>
        </div>



        <div v-if="step===3">
          <div class="mt-4">
            <h5>Wybierz metodę płatności</h5>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked>
              <label class="form-check-label" for="flexRadioDefault1">
                Płatność gotówką przy odbiorze
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
              <label class="form-check-label" for="flexRadioDefault2">
                Płatność gotówką przy odbiorze
              </label>
            </div>
          </div>
          <button type="button" class="btn btn-primary btn-lg btn-block mt-3" style="width: 100%" @click="setStep(4)">
            Przejdź do podsumowania zamówienia
          </button>
        </div>


        <div class="mt-3">
          <!--          <div class="card">wróć</div>-->
          <div class="alert alert-primary row">
            <div class="col">3. Podsumowanie</div>
            <div class="col-auto" v-if="step>3">
              <button type="button" class="btn btn-primary btn-block" @click="setStep(3)">
                Edytuj
              </button>
            </div>

          </div>
        </div>


<!--        <button>Zapisz i kontynuuj</button>-->


<!--        </form>-->




      </div>
    </div>
  </div>

</template>

<script>
export default {
  data() {
    return {
      step: 1
    }
  },
  methods: {
    setStep(step) {
      this.step = step
    }
  }
}
</script>