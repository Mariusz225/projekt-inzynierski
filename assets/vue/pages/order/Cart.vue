<template>
  <div class="container-lg">
    <div class="row">
      <div class="col-lg-8">

        <div id="product" class="row mt-3" v-for="productInCart in cartValue" :key="productInCart.productId">
          <div class="col-auto ">
            <img src="https://picsum.photos/200" class="img-product " alt="...">
          </div>
          <div class="col">
            {{productInCart.product.name}}

            <div style="width: 150px">
              <quantity-manager
                  :id="productInCart.productId"
                  :quantity-value="productInCart.quantity"
                  :product="productInCart.product"
              ></quantity-manager>

            </div>
          </div>
          <div class="col-auto">
            <div id="costForProduct" style="display: inline-block">

            </div>
            <div style="display: inline-block">{{ (Math.round(productInCart.quantity * productInCart.price * 100) / 100).toFixed(2) }}zł</div>
          </div>
        </div>
      </div>

      <div class="col-lg-4">
        <div>Podsumowanie</div>
        <div class="row justify-content-between">
          <div class="col-4">Suma</div>
          <div class="col-auto">
            <div id="costForProducts" style="display: inline-block"></div>
            <div style="display: inline-block">{{cartTotal}} zł</div>

          </div>
        </div>
        <div id="goToPaymentSm" class="card-footer text-muted" style="margin-top: 30px">
          <router-link :to="{ name: 'checkout' }">
            <button type="button" class="btn btn-primary btn-lg btn-block" style="width: 100%">Idź do kasy</button>
          </router-link>
        </div>


      </div>
    </div>
  </div>

</template>

<script>
import QuantityManager from "../../components/ui/product/QuantityManager";
export default {
  components: {QuantityManager},
  computed: {
    cartValue() {
      return this.$store.getters['cart/cartItems']
    },
    cartTotal() {
      return this.$store.getters['cart/cartTotal'].toFixed(2)
    },
  }
}
</script>

<style scoped>
@media screen and (max-width: 576px) {
  .img-product {
    height: 100px;
    width: 100px;
  }
}
@media screen and (min-width: 576px) {
  .img-product {
    height: 150px;
    width: 150px;
  }
}
</style>
