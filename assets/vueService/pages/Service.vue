<script>
export default {
  created() {
    var employeeInfo = this.$store.getters['employee/getEmployeeInfo']
    if (employeeInfo.position === 'Sklepikarz') {
      this.$router.push('shopkeeper');
    } else if (employeeInfo.position === 'Kierowca') {
      this.$router.push('driver');
    }
  }
}
</script>