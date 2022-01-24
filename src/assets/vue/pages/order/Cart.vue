<template>
  <div class="container-lg">
    <div class="row">
      <div class="col-lg-8">

        <div id="product" class="row mt-3" v-for="productInCart in cartValue" :key="productInCart.productId">
          <div class="col-auto ">
            <img src="https://picsum.photos/200" class="img-product " alt="...">
          </div>
          <div class="col">
<!--            {{productInCart.product.price}}-->
            {{productInCart.product.name}}


<!--            <div>-->
<!--              <div style="display: inline-block">Cena za 1 sztukę: </div>-->
<!--              <div id="priceForPiece" style="display: inline-block">54zł</div>-->
<!--            </div>-->

            <div style="width: 150px">
              <quantity-management
                  :id="productInCart.productId"
                  :quantity-value="productInCart.quantity"
                  :product="productInCart.product"
              ></quantity-management>

            </div>

<!--            <div class="row m-0 mb-2">-->
<!--              <button class="btn btn-primary btn-sm col-4" @click="">-->
<!--                - -->
<!--              </button>-->
<!--              <input name="quantity" class="col-4" v-model="productInCart.quantity" min="0" type="number">-->
<!--              <button class="btn btn-primary btn-sm col-4" @click="">-->
<!--                +-->
<!--              </button>-->
<!--            </div>-->



<!--            <div id="quantityManager" class="defaultInvisible btn-group mt-2">-->


<!--              <label for="quantity">-->
<!--                <button id="decrementButton" class="btn btn-primary btn-sm" onclick="decrement()">-->
<!--                  - -->
<!--                </button>-->
<!--                <input type="number" id="quantity" name="quantity" min="0" max="" size="2" v-model="productInCart.quantity"-->
<!--                >-->
<!--                <button id="incrementButton" class="btn btn-primary btn-sm" onclick="increment()">-->
<!--                  +-->
<!--                </button>-->
<!--              </label>-->

<!--            </div>-->

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
import QuantityManagement from "../../components/layout/cart/QuantityManagement";
export default {
  components: {QuantityManagement},
  computed: {
    cartValue() {
      // console.log(this.$store.getters['cart/cartItems'])
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
