<template>
  <the-service-navbar></the-service-navbar>

  <div class="container">
    <router-view></router-view>

  </div>

</template>

<script>
import TheServiceNavbar from "./components/layout/TheServiceNavbar";
export default {
  name: "AppService",
  components: {TheServiceNavbar},
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