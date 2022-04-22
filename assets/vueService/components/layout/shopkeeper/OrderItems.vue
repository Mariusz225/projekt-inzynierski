<template>

<!--  sss-->
  <div class="d-flex">
    <!--          <div class="col-auto ">-->
    <!--            <img src="https://picsum.photos/200" class="img-product " alt="...">-->
    <!--          </div>-->
    <div class="float-start">
      <img class="img-order-item"
           src="https://picsum.photos/200" alt="Sample">
    </div>

    <div class="card-body d-flex col-8">
      <div class="me-auto p-2 text-wrap">
        {{orderItem.quantity}} x {{orderItem.product.name}}

      </div>
      <div class="p-2 mb-auto mt-auto" @click="">
        <!--          <div>-->
        <!--            {{ orderItem.quantity }}-->
        <!--          </div>-->
        <!--          Komplemetuj-->
        <font-awesome-icon :icon="['far', 'check-circle']" class="fa-4x" style="color:green" v-if="!completed" @click="changeCompletionStatus"></font-awesome-icon>
        <font-awesome-icon :icon="['fas', 'check-circle']" class="fa-4x" style="color:green" v-if="completed" @click="changeCompletionStatus"></font-awesome-icon>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['orderItem'],
  emits: ['change-completed-status'],
  data() {
    return {
      completed: false
    }
  },
  computed: {
  },
  methods: {
    changeCompletionStatus() {
      this.completed = !this.completed;
      if (this.completed === true) {
        this.$emit('change-completed-status', true)
      } else {
        this.$emit('change-completed-status', false)
      }
    }
  }
}
</script>

<style scoped>
@media screen and (max-width: 576px) {
  .img-order-item {
    height: 100px;
    width: 100px;
  }
}
@media screen and (min-width: 576px) {
  .img-order-item {
    height: 150px;
    width: 150px;
  }
}
</style>