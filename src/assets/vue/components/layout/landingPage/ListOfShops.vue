<template>
    <div class="row">

      <div class="col-6">
        <div style="height:calc(100vh - 56px)" class="pt-4 d-flex flex-column">
<!--          <div class="">-->
            <div style="font-size: 42px" class="p-2">
              Zrób zakupy z domu zdalnie
            </div>
            <div style="font-size: 24px" class="p-2">
              Wybierz sklep
            </div>
            <div>
              <div id="store-list">
<!--                <div>-->
<!--                  Marker-->
<!--                </div>-->
              </div>
            </div>
<!--          </div>-->
          <div class="align-items-end mt-auto mb-2">
            <button type="button" class="btn btn-primary btn-lg btn-block" style="width: 100%" @click="setChosenShop">Zacznij zakupy</button>
          </div>

        </div>

      </div>

      <div class="col-6">
        <div class="map" id="map" ref="mapRef"></div>
      </div>

    </div>
</template>


<script>

import tt from '@tomtom-international/web-sdk-maps';

export default {
  name: 'Map',
  data() {
    return {
      mapRef: null,
      chosenShop: null,
      markers: []
    }
  },
  mounted() {
    const map = tt.map({
      key: 'YL8g12ID9MlokmZ7By1xFo14LQ5XGkTZ',
      container: this.$refs.mapRef,
      center: [17.0287200, 54.4640500],
      zoom: 10
    });

    const markers = [];
    const list = document.getElementById('store-list');

    this.shops.forEach(function (shop, index) {
      const city = 'city';
      const address = shop.address;
      const location = shop.coordinates;
      const id = shop.id
      const marker = new tt.Marker().setLngLat(location).setPopup(new tt.Popup({offset: 35}).setHTML(address)).addTo(map);
      markers[index] = {marker, city};
      // console.log(marker.getPopup())
      let storesList = document.getElementById(city);
      if (storesList === null) {
        storesList = list.appendChild(document.createElement('div'));
      }
      const  details = buildLocation(storesList, address, id);

      marker._element.addEventListener('click',
          (function (details) {

            const activeItem = document.getElementsByClassName('btn-primary');
            return function () {
              if (activeItem[0]) {
                // console.log(activeItem[0])
                activeItem[0].classList.add('btn--outline-primary');
                activeItem[0].classList.remove('btn-primary');
              }
              this.chosenShop = details.id;

              details.classList.remove('btn-outline-primary');
              details.classList.add('btn-primary');
            }
          })(details, city)
      );
      details.addEventListener('click',
          (function (marker) {
            const activeItem = document.getElementsByClassName('btn-primary');
            return function () {
              // console.log(activeItem)
              if (activeItem[0]) {
                // console.log(activeItem[0])
                activeItem[0].classList.add('btn-outline-primary');
                activeItem[0].classList.remove('btn-primary');
              }
              // this.setChosenShop();
              // this.chosenShop = details.id;
              // this.$set(this.chosenChop, details.id)
              // this.setChosenShop();

              details.classList.remove('btn-outline-primary');
              details.classList.add('btn-primary');
              map.easeTo({
                center: marker.getLngLat(),
                zoom: 18
              });
              closeAllPopups();

              marker.togglePopup();
            }
          })(marker)
      );
    })

    function buildLocation(htmlParent, text, id) {
      const details = htmlParent.appendChild(document.createElement('xd'));
      details.href = '#';
      details.className = 'btn btn-outline-primary';
      details.innerHTML = text;
      details.setAttribute("id", id);
      return details;
    }

    function closeAllPopups() {
      markers.forEach(marker => {
        if (marker.marker.getPopup().isOpen()) {
          marker.marker.togglePopup();
        }
      });
    }

    map.addControl(new tt.FullscreenControl());
    map.addControl(new tt.NavigationControl());

  },

  computed: {
    shops() {
      return this.$store.getters['shops/shops'];
    }
  },
  methods: {
    setChosenShop() {
      // this.chosenShop = id
      console.log('this.chosenShop')
    }
  }
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
  top: 0;
}
</style>


<!--<template>-->
<!--  <div class="row">-->

<!--    <div class="col-6">-->
<!--      <div style="height:calc(100vh - 56px)" class="pt-4 d-flex flex-column">-->
<!--        &lt;!&ndash;          <div class="">&ndash;&gt;-->
<!--        <div style="font-size: 42px" class="p-2">-->
<!--          Zrób zakupy z domu zdalnie-->
<!--        </div>-->
<!--        <div style="font-size: 24px" class="p-2">-->
<!--          Wybierz sklep-->
<!--        </div>-->
<!--        <div>-->
<!--          <div id="store-list">-->
<!--            &lt;!&ndash;                <div>&ndash;&gt;-->
<!--            &lt;!&ndash;                  Marker&ndash;&gt;-->
<!--            &lt;!&ndash;                </div>&ndash;&gt;-->
<!--          </div>-->
<!--        </div>-->
<!--        &lt;!&ndash;          </div>&ndash;&gt;-->
<!--        <div class="align-items-end mt-auto mb-2">-->
<!--          <button type="button" class="btn btn-primary btn-lg btn-block" style="width: 100%" @click="setChosenShop">Zacznij zakupy</button>-->
<!--        </div>-->

<!--      </div>-->

<!--    </div>-->

<!--    <div class="col-6">-->
<!--      <div class="map" id="map" ref="mapRef"></div>-->
<!--    </div>-->

<!--  </div>-->
<!--</template>-->


<!--<script>-->

<!--import tt from '@tomtom-international/web-sdk-maps';-->

<!--export default {-->
<!--  name: 'Map',-->
<!--  data() {-->
<!--    return {-->
<!--      map: null,-->
<!--      chosenShop: null,-->
<!--      markers: []-->
<!--    }-->
<!--  },-->

<!--  methods: {-->
<!--    initializeMap() {-->
<!--      const mapContainer = this.$refs.mapRef-->
<!--      this.map = tt.map({-->
<!--        key: 'YL8g12ID9MlokmZ7By1xFo14LQ5XGkTZ',-->
<!--        container: mapContainer,-->
<!--        center: [-120.72217631449985, 42.73919549715691],-->
<!--        zoom: 10-->
<!--      });-->

<!--      this.map.addControl(new tt.FullscreenControl());-->
<!--      this.map.addControl(new tt.NavigationControl());-->

<!--      new tt.Marker()-->
<!--          .setLngLat([-120.72217631449985, 42.73919549715691])-->
<!--          // .setPopup(new tt.Popup({offset: 35})-->
<!--          //     .setHTML('address'))-->
<!--          .addTo(this.map);-->

<!--    },-->
<!--    addMarker() {-->
<!--      new tt.Marker().setLngLat([45, 43]).setPopup(new tt.Popup({offset: 35}).setHTML('address')).addTo(this.map);-->
<!--    },-->
<!--    createMarker() {-->
<!--      var markerElement = document.createElement('div');-->
<!--      markerElement.className = 'marker';-->

<!--      var markerContentElement = document.createElement('div');-->
<!--      markerContentElement.className = 'marker-content';-->
<!--      // markerContentElement.style.backgroundColor = color;-->
<!--      markerElement.appendChild(markerContentElement);-->

<!--      var iconElement = document.createElement('div');-->
<!--      iconElement.className = 'marker-icon';-->
<!--      // iconElement.style.backgroundImage =-->
<!--      //     'url(https://api.tomtom.com/maps-sdk-for-web/cdn/static/' + icon + ')';-->
<!--      markerContentElement.appendChild(iconElement);-->

<!--      // var popup = new tt.Popup({offset: 30}).setText(popupText);-->
<!--      // add marker to map-->
<!--      new tt.Marker({element: markerElement, anchor: 'bottom'})-->
<!--          .setLngLat([-120.72217631449985, 42.73919549715691])-->
<!--          // .setPopup(popup)-->
<!--          .addTo(this.map);-->
<!--    }-->
<!--  },-->

<!--  async mounted() {-->
<!--    this.initializeMap()-->
<!--    // this.addMarker()-->

<!--    // this.createMarker()-->

<!--    // const map = tt.map({-->
<!--    //   key: 'YL8g12ID9MlokmZ7By1xFo14LQ5XGkTZ',-->
<!--    //   container: this.$refs.mapRef,-->
<!--    //   center: [17.0287200, 54.4640500],-->
<!--    //   zoom: 10-->
<!--    // });-->

<!--    // const markers = [];-->
<!--    const list = document.getElementById('store-list');-->

<!--    // this.shops.forEach(function (shop, index) {-->
<!--    //   const city = 'city';-->
<!--    //   const address = shop.address;-->
<!--    //   const location = shop.coordinates;-->
<!--    //   const id = shop.id-->
<!--    //   const marker = new tt.Marker().setLngLat(location).setPopup(new tt.Popup({offset: 35}).setHTML(address)).addTo(map);-->
<!--    //   markers[index] = {marker, city};-->
<!--    //   // console.log(marker.getPopup())-->
<!--    //   let storesList = document.getElementById(city);-->
<!--    //   if (storesList === null) {-->
<!--    //     storesList = list.appendChild(document.createElement('div'));-->
<!--    //   }-->
<!--    //   const  details = buildLocation(storesList, address, id);-->
<!--    //-->
<!--    //   marker._element.addEventListener('click',-->
<!--    //       (function (details) {-->
<!--    //-->
<!--    //         const activeItem = document.getElementsByClassName('btn-primary');-->
<!--    //         return function () {-->
<!--    //           if (activeItem[0]) {-->
<!--    //             // console.log(activeItem[0])-->
<!--    //             activeItem[0].classList.add('btn&#45;&#45;outline-primary');-->
<!--    //             activeItem[0].classList.remove('btn-primary');-->
<!--    //           }-->
<!--    //           this.chosenShop = details.id;-->
<!--    //-->
<!--    //           details.classList.remove('btn-outline-primary');-->
<!--    //           details.classList.add('btn-primary');-->
<!--    //         }-->
<!--    //       })(details, city)-->
<!--    //   );-->
<!--    //   details.addEventListener('click',-->
<!--    //       (function (marker) {-->
<!--    //         const activeItem = document.getElementsByClassName('btn-primary');-->
<!--    //         return function () {-->
<!--    //           // console.log(activeItem)-->
<!--    //           if (activeItem[0]) {-->
<!--    //             // console.log(activeItem[0])-->
<!--    //             activeItem[0].classList.add('btn-outline-primary');-->
<!--    //             activeItem[0].classList.remove('btn-primary');-->
<!--    //           }-->
<!--    //           // this.setChosenShop();-->
<!--    //           // this.chosenShop = details.id;-->
<!--    //           // this.$set(this.chosenChop, details.id)-->
<!--    //           // this.setChosenShop();-->
<!--    //-->
<!--    //           details.classList.remove('btn-outline-primary');-->
<!--    //           details.classList.add('btn-primary');-->
<!--    //           map.easeTo({-->
<!--    //             center: marker.getLngLat(),-->
<!--    //             zoom: 18-->
<!--    //           });-->
<!--    //           closeAllPopups();-->
<!--    //-->
<!--    //           marker.togglePopup();-->
<!--    //         }-->
<!--    //       })(marker)-->
<!--    //   );-->
<!--    // })-->

<!--    function buildLocation(htmlParent, text, id) {-->
<!--      const details = htmlParent.appendChild(document.createElement('xd'));-->
<!--      details.href = '#';-->
<!--      details.className = 'btn btn-outline-primary';-->
<!--      details.innerHTML = text;-->
<!--      details.setAttribute("id", id);-->
<!--      return details;-->
<!--    }-->

<!--    function closeAllPopups() {-->
<!--      markers.forEach(marker => {-->
<!--        if (marker.marker.getPopup().isOpen()) {-->
<!--          marker.marker.togglePopup();-->
<!--        }-->
<!--      });-->
<!--    }-->

<!--    // map.addControl(new tt.FullscreenControl());-->
<!--    // map.addControl(new tt.NavigationControl());-->

<!--  },-->

<!--  computed: {-->
<!--    shops() {-->
<!--      return this.$store.getters['shops/shops'];-->
<!--    }-->
<!--  }-->
<!--}-->
<!--</script>-->

<!--<style scoped>-->
<!--@import "https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.64.0/maps/maps.css";-->
<!--html {-->
<!--  -webkit-box-sizing: border-box;-->
<!--  box-sizing: border-box;-->
<!--}-->

<!--*, *:before, *:after {-->
<!--  box-sizing: inherit;-->
<!--}-->

<!--body {-->
<!--  color: #707070;-->
<!--  font-size: 14px;-->
<!--  margin: 0;-->
<!--  padding: 0;-->
<!--}-->

<!--a {-->
<!--  text-decoration: none;-->
<!--}-->

<!--.map {-->
<!--  height: calc(100vh - 56px) ;-->
<!--  width: 100%;-->
<!--  bottom: 0;-->
<!--  top: 0;-->
<!--}-->
<!--</style>-->