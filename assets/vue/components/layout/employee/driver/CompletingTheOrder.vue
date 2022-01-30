<template>
  <div>
    <div class="card-body d-flex">
      <div class="">
      </div>
      <div class="me-auto p-2 d-flex">

        <div class="m-auto">
          Zamówienie - {{order.id}}

        </div>

      </div>

      <div class="p-2">
        <font-awesome-icon :icon="['far', 'check-circle']" class="fa-2x" style="color:green" v-if="!completed" @click="changeStatus"></font-awesome-icon>
        <font-awesome-icon :icon="['fas', 'check-circle']" class="fa-2x" style="color:green" v-if="completed" @click="changeStatus"></font-awesome-icon>
      </div>



    </div>
  </div>
</template>

<script>
export default {
  props: ['order'],
  emits: ['change-status'],
  data() {
    return {
      completed: false
    }
  },
  methods: {
    changeStatus() {
      this.completed = !this.completed;
      if (this.completed === true) {
        this.$emit('change-status', true)
      } else {
        this.$emit('change-status', false)
      }
    }
  }
}
</script>