<template>
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
  <button type="button" class="btn btn-primary btn-lg btn-block mt-3" style="width: 100%" @click="goToSummary">
    Przejdź do podsumowania zamówienia
  </button>
</template>

<script>
export default {
  props: {},
  emits: ['set-step'],
  methods: {
    goToSummary() {
      this.$emit('set-step', 4);
    },
  }
}
</script>