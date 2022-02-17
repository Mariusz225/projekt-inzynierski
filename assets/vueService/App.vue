<template>
  <the-service-navbar></the-service-navbar>

  <div class="container" v-if="employeeInfoIsLoaded">
<!--    <div v-if="employeeInfo.position === 'Sklepikarz'">-->
<!--      sss-->
<!--    </div>-->
<!--    <div v-if="employeeInfo.position === 'Kierowca'">-->
<!--      sssaa-->
<!--    </div>-->
<!--    Dane Osoby -> zacznij prację czy coś-->
<!--    {{employeeInfo}}-->

    <router-view></router-view>

  </div>

</template>

<script>
import TheServiceNavbar from "./components/layout/TheServiceNavbar";
export default {
  // name: "AppService",
  components: {TheServiceNavbar},
  data() {
    return {
      employeeInfoIsLoaded: false
    }
  },
  computed: {
    employeeInfo() {
      return this.$store.getters['employee/getEmployeeInfo'];
    }
  },
  methods: {
    //TODO jaki sklep, jaka funkcja
    async downloadEmployeeInfo() {
      try {
        await this.$store.dispatch('employee/getEmployeeInfo')
      } catch (error) {

      }
      // var employeeInfo = this.$store.getters['employee/getEmployeeInfo']
      // if (employeeInfo.position === 'Sklepikarz') {
      //
      // } else if (employeeInfo.position === 'Kierowca') {
      //
      // }
      this.employeeInfoIsLoaded = true;
    }
  },
  created() {
    this.downloadEmployeeInfo()
  }
}
</script>

<style>
@import'~bootstrap/dist/css/bootstrap.css';

</style>