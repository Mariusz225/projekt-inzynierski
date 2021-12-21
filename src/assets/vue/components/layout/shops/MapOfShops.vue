<template>
<!--  <h1>Vue 3 TomTom Maps Demo</h1>-->
<!--  <div id='map' ref="mapRef"></div>-->
  <div class="control-panel">
    <div class="heading">

    </div>
    <div id="store-list"></div>
  </div>
  <div class="map" id="map" ref="mapRef"></div>
<!--  <div v-for="shop in shops">-->
<!--    a-->
<!--  </div>-->
</template>

<script>

import tt from '@tomtom-international/web-sdk-maps';

import {computed, onMounted, ref} from "vue";
import {useStore} from "vuex";



export default {
  name: 'Map',
  setup() {
    const mapRef = ref(null);

    const store = useStore();
    const shops = computed(() => store.getters['shops/shops']);

    // console.log(shops.value.features)







    // console.log(shops.value);


    onMounted(() => {
      // const tt = window.tt;
      var map = tt.map({
        key: 'YL8g12ID9MlokmZ7By1xFo14LQ5XGkTZ',
        container: mapRef.value,
        center: [4.573040, 52.138950],
        zoom: 9
      });

      const markersCity = [];
      const list = document.getElementById('store-list');

      shops.value.features.forEach(function (shop, index) {
        const city = shop.properties.city;
        const address = shop.properties.address;
        const location = shop.geometry.coordinates;
        const marker = new tt.Marker().setLngLat(location).setPopup(new tt.Popup({offset: 35}).setHTML(address)).addTo(map);
        markersCity[index] = {marker, city};
        let cityStoresList = document.getElementById(city);
        if (cityStoresList === null) {
          const cityStoresListHeading = list.appendChild(document.createElement('h3'));
          cityStoresListHeading.innerHTML = city;
          cityStoresList = list.appendChild(document.createElement('div'));
          cityStoresList.id = city;
          cityStoresList.className = 'list-entries-container';
          cityStoresListHeading.addEventListener('click', function (e) {
            map.fitBounds(getMarkersBoundsForCity(e.target.innerText), {padding: 50});
          });
        }
        const  details = buildLocation(cityStoresList, address);
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
                closeAllPopups();
                marker.togglePopup();
              }
            })(marker)
        );
      })

      function getMarkersBoundsForCity(city) {
        const bounds = new tt.LngLatBounds();
        markersCity.forEach(markerCity => {
          if (markerCity.city === city) {
            bounds.extend(markerCity.marker.getLngLat());
          }
        });
        return bounds;
      }

      function buildLocation(htmlParent, text) {
        const details = htmlParent.appendChild(document.createElement('a'));
        details.href = '#';
        details.className = 'list-entry';
        details.innerHTML = text;
        return details;
      }

      function closeAllPopups() {
        markersCity.forEach(markerCity => {
          if (markerCity.marker.getPopup().isOpen()) {
            markerCity.marker.togglePopup();
          }
        });
      }



      map.addControl(new tt.FullscreenControl());
      map.addControl(new tt.NavigationControl());


    })

    // function addMarker(map) {
    //   var location = [4.573040, 52.138950];
    //   var popupOffset = 25;
    //
    //   var marker = new tt.Marker().setLngLat(location).addTo(map);
    //   var popup = new tt.Popup({ offset: popupOffset }).setHTML("Your address!");
    //   marker.setPopup(popup).togglePopup();
    // }

    return {
      mapRef,
      shops
    }
  },
}
</script>

<style>
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
  bottom: 0;
  left: 25%;
  position: absolute;
  top: 0;
  width: 75%;
  z-index: -1;
}

.control-panel {
  -webkit-box-shadow: 0px 0px 12px 0px rgba(0, 0, 0, 0.3);
  box-shadow: 0px 0px 12px 0px rgba(0, 0, 0, 0.3);
  height: 100%;
  left: 0;
  overflow: hidden;
  position: absolute;
  top: 0;
  width: 25%;
}

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
</style>