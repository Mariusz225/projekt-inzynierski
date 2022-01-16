<template>
  <!--  <h1>Vue 3 TomTom Maps Demo</h1>-->
  <!--  <div id='map' ref="mapRef"></div>-->

<!--  <div style="height: 75vh" class="container">-->
    <!--&lt;!&ndash;    <div class="card h-100">&ndash;&gt;-->
    <div class="row">
      <div class="col-6">
        <div style="height:calc(100vh - 56px)" class="pt-4">
          <div class="align-bottom">
            <div style="font-size: 42px">
              Zrób zakupy z domu zdalnie
            </div>
            <div style="font-size: 24px">
              Wybierz sklep

            </div>
            <div>
              <div id="store-list"></div>

<!--              Chcesz sprawdzić ile zaoszczędzisz czasu kupując zakupy spożywcze z dowozem do domu? Wystarczy że wybierzesz sklep, to takie proste.-->

            </div>
          </div>
        </div>

<!--        Chcesz sprawdzić ile zaoszczędzisz czasu kupując zakupy spożywcze z dowozem do domu? Wystarczy że wybierzesz sklep, to takie proste.-->
<!--        <div class="control-panel">-->
<!--          <div class="heading">-->

<!--          </div>-->
<!--          <div id="store-list"></div>-->
<!--        </div>-->
<!--        <div class="_25w_ _69fb _31bb _25w-"><div class="_1n-z _6hy- _4wry _8w-8" style="color:">Meta Careers: Discover who we are, what we do, and why we do it.</div><div class="_6hy- _4wrx _8w-7" style="color:">When we build for the world, we bring our talents, experiences, and passions with us. Through our unique stories, we help bring the world closer together. </div><br><div class="_1kym _1kwt"><div class="_6e7d"><div class="_6b8q"><div class="_1kxh _3-9a"></div></div><input aria-label=" Search Jobs " class="_1kwy" placeholder=" Search Jobs " id="u_0_3v_0i"><div class="_6e87"><div id="u_0_0_sP"></div><div class="_9nyu" id="u_0_3w_Vh"><a href="#" class="_8yh9" ajaxify="" rel="noopener" role="button"><div class="_8yha"><div class="_8yi1"><svg width="24px" height="24px" viewBox="0 0 38 38" version="1.1" xmlns="http://www.w3.org/2000/svg"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g transform="translate(-5.000000, -5.000000)"><g transform="translate(6.000000, 6.000000)"><circle stroke="#38444F" cx="18" cy="18" r="18"></circle><g transform="translate(11.000000, 13.000000)" stroke="#38444F" stroke-width="2"><polyline stroke-linecap="square" points="8 0 13 5 8 10"></polyline><path d="M0,5 L13,5"></path></g></g></g></g></svg></div><div class="_8yhb _93ft" style="color: #38444F"><span class="_8qri">See All Job Results</span></div></div></a></div></div></div></div><br><br><div class="_25x1 _25x7 _1ilv _1iot _38g3 _6c95" style="background-color: "><div class="_25w_ _69fb _31bb _25w-"><div class="_9nyu" id="u_0_3x_/D"><a href="/jobs" class="_8yh9" ajaxify="" rel="noopener"><div class="_8yha"><div class="_8yi1"><svg width="38px" height="38px" viewBox="0 0 38 38" version="1.1" xmlns="http://www.w3.org/2000/svg"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g transform="translate(-5.000000, -5.000000)"><g transform="translate(6.000000, 6.000000)"><circle stroke="#232323" cx="18" cy="18" r="18"></circle><g transform="translate(11.000000, 13.000000)" stroke="#232323" stroke-width="2"><polyline stroke-linecap="square" points="8 0 13 5 8 10"></polyline><path d="M0,5 L13,5"></path></g></g></g></g></svg></div><div class="_8yhb" style="color: #232323">View All Jobs</div></div></a></div></div></div></div>-->
      </div>
      <div class="col-6">
<!--        <div class="control-panel">-->
<!--          <div class="heading">-->

<!--          </div>-->
<!--          <div id="store-list"></div>-->
<!--        </div>-->
        <div class="map" id="map" ref="mapRef"></div>
        <!--  <div v-for="shop in shops">-->
        <!--    a-->
        <!--  </div>-->
      </div>
    </div>

    <!--&lt;!&ndash;    </div>&ndash;&gt;-->
<!--  </div>-->


  <!--  <div class="control-panel">-->
  <!--    <div class="heading">-->

  <!--    </div>-->
  <!--    <div id="store-list"></div>-->
  <!--  </div>-->
  <!--  <div class="map" id="map" ref="mapRef"></div>-->
  <!--&lt;!&ndash;  <div v-for="shop in shops">&ndash;&gt;-->
  <!--&lt;!&ndash;    a&ndash;&gt;-->
  <!--&lt;!&ndash;  </div>&ndash;&gt;-->
</template>

<!--<script>-->

<!--import tt from '@tomtom-international/web-sdk-maps';-->

<!--import {computed, onMounted, ref} from "vue";-->
<!--import {useStore} from "vuex";-->



<!--export default {-->
<!--  name: 'Map',-->
<!--  setup() {-->
<!--    const mapRef = ref(null);-->

<!--    const store = useStore();-->
<!--    const shops = computed(() => store.getters['shops/shops']);-->

<!--    // console.log(shops.value.features)-->







<!--    // console.log(shops.value);-->


<!--    onMounted(() => {-->
<!--      // const tt = window.tt;-->
<!--      var map = tt.map({-->
<!--        key: 'YL8g12ID9MlokmZ7By1xFo14LQ5XGkTZ',-->
<!--        container: mapRef.value,-->
<!--        center: [4.573040, 52.138950],-->
<!--        zoom: 9-->
<!--      });-->

<!--      const markers = [];-->
<!--      const list = document.getElementById('store-list');-->

<!--      shops.value.features.forEach(function (shop, index) {-->
<!--        const city = shop.properties.city;-->
<!--        const address = shop.properties.address;-->
<!--        const location = shop.geometry.coordinates;-->
<!--        const marker = new tt.Marker().setLngLat(location).setPopup(new tt.Popup({offset: 35}).setHTML(address)).addTo(map);-->
<!--        // markersCity[index] = {marker, city};-->
<!--        markers[index] = {markers};-->
<!--        // let cityStoresList = document.getElementById(city);-->
<!--        // let cityStoresList = document.getElementById(city);-->
<!--        // if (cityStoresList === null) {-->
<!--        //   const cityStoresListHeading = list.appendChild(document.createElement('h3'));-->
<!--        //   cityStoresListHeading.innerHTML = city;-->
<!--        //   cityStoresList = list.appendChild(document.createElement('div'));-->
<!--        //   // cityStoresList.id = city;-->
<!--        //   // cityStoresList.className = 'list-entries-container';-->
<!--        //   cityStoresListHeading.addEventListener('click', function (e) {-->
<!--        //     map.fitBounds(getMarkersBoundsForCity(e.target.innerText), {padding: 50});-->
<!--        //   });-->
<!--        // }-->
<!--        let storesList = document.getElementById(city);-->
<!--        if (storesList === null) {-->
<!--          // const cityStoresListHeading = list.appendChild(document.createElement('h3'));-->
<!--          // cityStoresListHeading.innerHTML = city;-->
<!--          storesList = list.appendChild(document.createElement('div'));-->
<!--          // cityStoresList.id = city;-->
<!--          // cityStoresList.className = 'list-entries-container';-->
<!--          // cityStoresListHeading.addEventListener('click', function (e) {-->
<!--          //   map.fitBounds(getMarkersBoundsForCity(e.target.innerText), {padding: 50});-->
<!--          // });-->
<!--        }-->
<!--        const  details = buildLocation(storesList, address);-->
<!--        marker._element.addEventListener('click',-->
<!--            (function (details, city) {-->
<!--              const activeItem = document.getElementsByClassName('selected');-->
<!--              return function () {-->
<!--                if (activeItem[0]) {-->
<!--                  activeItem[0].classList.remove('selected');-->
<!--                }-->
<!--                details.classList.add('selected');-->
<!--              }-->
<!--            })(details, city)-->
<!--        );-->
<!--        details.addEventListener('click',-->
<!--            (function (marker) {-->
<!--              const activeItem = document.getElementsByClassName('selected');-->
<!--              return function () {-->
<!--                if (activeItem[0]) {-->
<!--                  activeItem[0].classList.remove('selected');-->
<!--                }-->
<!--                details.classList.add('selected');-->
<!--                map.easeTo({-->
<!--                  center: marker.getLngLat(),-->
<!--                  zoom: 18-->
<!--                });-->
<!--                closeAllPopups();-->
<!--                marker.togglePopup();-->
<!--              }-->
<!--            })(marker)-->
<!--        );-->
<!--      })-->

<!--      function getMarkersBoundsForCity(city) {-->
<!--        const bounds = new tt.LngLatBounds();-->
<!--        markersCity.forEach(markerCity => {-->
<!--          if (markerCity.city === city) {-->
<!--            bounds.extend(markerCity.marker.getLngLat());-->
<!--          }-->
<!--        });-->
<!--        return bounds;-->
<!--      }-->

<!--      function buildLocation(htmlParent, text) {-->
<!--        const details = htmlParent.appendChild(document.createElement('a'));-->
<!--        details.href = '#';-->
<!--        details.className = 'list-entry';-->
<!--        details.innerHTML = text;-->
<!--        return details;-->
<!--      }-->

<!--      function closeAllPopups() {-->
<!--        markersCity.forEach(markerCity => {-->
<!--          if (markerCity.marker.getPopup().isOpen()) {-->
<!--            markerCity.marker.togglePopup();-->
<!--          }-->
<!--        });-->
<!--      }-->



<!--      map.addControl(new tt.FullscreenControl());-->
<!--      map.addControl(new tt.NavigationControl());-->


<!--    })-->

<!--    // function addMarker(map) {-->
<!--    //   var location = [4.573040, 52.138950];-->
<!--    //   var popupOffset = 25;-->
<!--    //-->
<!--    //   var marker = new tt.Marker().setLngLat(location).addTo(map);-->
<!--    //   var popup = new tt.Popup({ offset: popupOffset }).setHTML("Your address!");-->
<!--    //   marker.setPopup(popup).togglePopup();-->
<!--    // }-->

<!--    return {-->
<!--      mapRef,-->
<!--      shops-->
<!--    }-->
<!--  },-->
<!--  // created() {-->
<!--  //   import {useStore} from "vuex";-->
<!--  //-->
<!--  //   const store = useStore();-->
<!--  //-->
<!--  //   store.dispatch('shops/fetchShops');-->
<!--  //-->
<!--  //-->
<!--  //   console.log('ss');-->
<!--  // }-->
<!--}-->
<!--</script>-->

<script>

import tt from '@tomtom-international/web-sdk-maps';

import {computed, onBeforeMount, onMounted, ref} from "vue";
import {useStore} from "vuex";



export default {
  name: 'Map',
  setup() {
    const mapRef = ref(null);

    const store = useStore();
    const shops = computed(() => store.getters['shops/shops']);

    onMounted(() => {
      var map = tt.map({
        key: 'YL8g12ID9MlokmZ7By1xFo14LQ5XGkTZ',
        container: mapRef.value,
        center: [4.573040, 52.138950],
        zoom: 9
      });

      const markers = [];
      const list = document.getElementById('store-list');

      console.log(shops)

      shops.value.features.forEach(function (shop, index) {
        console.log(shop)
        const city = shop.properties.city;
        const address = shop.properties.address;
        const location = shop.geometry.coordinates;
        const marker = new tt.Marker().setLngLat(location).setPopup(new tt.Popup({offset: 35}).setHTML(address)).addTo(map);
        markers[index] = {markers};
        let storesList = document.getElementById(city);
        if (storesList === null) {
          storesList = list.appendChild(document.createElement('div'));
        }
        const  details = buildLocation(storesList, address);
        marker._element.addEventListener('click',
            (function (details, city) {
              const activeItem = document.getElementsByClassName('selected');
              return function () {
                if (activeItem[0]) {
                  activeItem[0].classList.remove('selected');
                }
                details.classList.add('selected');
              }
            })(details, city)
        );
        details.addEventListener('click',
            (function (marker) {
              const activeItem = document.getElementsByClassName('selected');
              return function () {
                if (activeItem[0]) {
                  activeItem[0].classList.remove('selected');
                }
                details.classList.add('selected');
                map.easeTo({
                  center: marker.getLngLat(),
                  zoom: 18
                });
                marker.togglePopup();
              }
            })(marker)
        );
      })

      function buildLocation(htmlParent, text) {
        const details = htmlParent.appendChild(document.createElement('a'));
        details.href = '#';
        details.className = 'list-entry';
        details.innerHTML = text;
        return details;
      }



      map.addControl(new tt.FullscreenControl());
      map.addControl(new tt.NavigationControl());


    })

    onBeforeMount(() => {
      store.dispatch('shops/fetchShops')
      // if (store.getters['shops/shops'] === null) {
      //
      // }
    })


    return {
      mapRef,
      shops
    }
  },
  // created() {
  //   import {useStore} from "vuex";
  //
  //   const store = useStore();
  //
  //   store.dispatch('shops/fetchShops');
  //
  //
  //   console.log('ss');
  // }
}
</script>

<style scoped>
@import "https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.64.0/maps/maps.css";
html {
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
}

*, *:before, *:after {
  box-sizing: inherit;
}

body {
  color: #707070;
  font-size: 14px;
  margin: 0;
  padding: 0;
}

a {
  text-decoration: none;
}

.map {
  height: calc(100vh - 56px) ;
  width: 100%;
  bottom: 0;
  /*left: 25%;*/
  /*position: absolute;*/
  top: 0;
  /*width: 75%;*/
  /*z-index: -1;*/
}

/*.control-panel {*/
/*  -webkit-box-shadow: 0px 0px 12px 0px rgba(0, 0, 0, 0.3);*/
/*  box-shadow: 0px 0px 12px 0px rgba(0, 0, 0, 0.3);*/
/*  height: 100%;*/
/*  !*right: 0;*!*/
/*  overflow: hidden;*/
/*  !*position: absolute;*!*/
/*  top: 0;*/
/*  width: 100%;*/
/*}*/

.heading {
  background: #fff;
  border-bottom: 1px solid #eee;
  -webkit-box-shadow: 0px 3px 6px 0px rgba(0, 0, 0, 0.16);
  box-shadow: 0px 3px 6px 0px rgba(0, 0, 0, 0.16);
  position: relative;
  z-index: 1;
}

.heading > img {
  height: auto;
  margin: 10px 0 8px 0;
  width: 150px;
}

#store-list {
  height: 100%;
  overflow: auto;
}

#store-list .list-entries-container .list-entry {
  border-bottom: 1px solid #e8e8e8;
  display: block;
  padding: 10px 50px 10px;
}

#store-list .list-entries-container .list-entry:nth-of-type(even) {
  background-color: #f5f5f5;
}

#store-list .list-entries-container .list-entry:hover,
#store-list .list-entries-container .list-entry.selected {
  background-color: #CDDE75;
  border-bottom-color: #CDDE75;
}

.vertical-center {
  display: flex;
  align-items: center;
}
</style>