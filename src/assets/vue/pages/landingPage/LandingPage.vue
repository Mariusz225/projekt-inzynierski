<template>
  <!--56px-->
  <div style="height: 75vh" class="container">
<!--&lt;!&ndash;    <div class="card h-100">&ndash;&gt;-->
<!--      <div class="row">-->
<!--        <div class="col-6">-->
<!--          Chcesz sprawdzić ile zaoszczędzisz czasu kupując zakupy spożywcze z dowozem do domu?-->
<!--        </div>-->
<!--        <div class="col-6">-->
          <list-of-shops></list-of-shops>
<!--        </div>-->
<!--      </div>-->

<!--&lt;!&ndash;    </div>&ndash;&gt;-->
  </div>

</template>


<script>
import ListOfShops from "../../components/layout/landingPage/ListOfShops";
export default {
  name: 'App',
  components: {ListOfShops}
}
</script>
