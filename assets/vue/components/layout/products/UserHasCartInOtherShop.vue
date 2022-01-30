<template>
<!--  <div v-if="showModal">-->
    <transition name="modal">
      <div class="modal-mask">
        <div class="modal-wrapper">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Ostrzeżenie</h5>
              </div>
              <div class="modal-body">
                <p>Posiadasz koszyk w innym sklepie. Kontynuując przejdziesz do nowego sklepu, a przedmioty z posiadanego koszyka zostaną usunięte.</p>
              </div>
              <div class="modal-footer">
                <router-link :to="{ name: 'shop', params: {shopId: shopId} }">
                  <button type="button" class="btn btn-secondary">Anuluj</button>
                </router-link>
                <button type="button" class="btn btn-primary" @click="removeCartAndReload">Kontynuuj</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </transition>
<!--  </div>-->
<!--  <button @click="showModal = true">Click</button>-->
</template>

<script>
export default {
  data() {
    return {
      // showModal: false
    }
  },
  props:['shopId'],
  methods: {
    async removeCartAndReload() {
      try {
        await this.$store.dispatch('cart/removeCart')
      } catch (error) {

      }
      // this.$router.go(null);

    }
  },
}
</script>