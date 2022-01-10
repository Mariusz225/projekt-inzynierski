<template>
  <h1>
    navbar serwis
  </h1>
  <router-view></router-view>

</template>

<script>
export default {
  name: "AppService",
  methods: {
    //TODO jaki sklep, jaka funkcja
    async downloadEmployeeInfo() {
      try {
        await this.$store.dispatch('employee/getEmployeeInfo')
      } catch (error) {

      }
    }
  },
  created() {
    // this.downloadEmployeeInfo()
  }
}
</script>