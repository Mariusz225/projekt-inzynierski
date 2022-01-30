<template>
  <div class="row">

    <div class="col-6">
      <div style="height:calc(100vh - 56px)" class="pt-4 d-flex flex-column">
        <div style="font-size: 42px" class="p-2">
          Zrób zakupy z domu zdalnie
        </div>
        <div style="font-size: 24px" class="p-2">
          Wybierz sklep
        </div>
        <div>
          <div id="store-list" v-for="shop in shops">
            <div class="btn btn-primary" v-if="chosenShop === shop.id" @click="setChosenShop(shop.id)">
              {{shop.address}}
            </div>
            <div class="btn btn-outline-primary" v-else @click="setChosenShop(shop.id)">
              {{shop.address}}
            </div>
          </div>
        </div>
        <div class="align-items-end mt-auto mb-2" v-if="chosenShop !== null">
            <router-link :to="{ name: 'shop', params: {shopId: this.chosenShop} }">
              <button type="button" class="btn btn-primary btn-lg btn-block" style="width: 100%">
                Przejdź do sklepu

              </button>

            </router-link>
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
      map: null,
      chosenShop: null,
      markers: []
    }
  },

  methods: {
    setChosenShop(id) {
      this.chosenShop = id

      this.map.easeTo({
        center: this.markers[id - 1].getLngLat(),
        zoom: 18
      });
    },
    initializeMap() {
      const map = tt.map({
        key: 'YL8g12ID9MlokmZ7By1xFo14LQ5XGkTZ',
        container: this.$refs.mapRef,
        center: [17.0287200, 54.4640500],
        zoom: 10
      });


      map.addControl(new tt.FullscreenControl());
      map.addControl(new tt.NavigationControl());

      this.map = Object.freeze(map);

      this.shops.forEach((shop) => {
        this.createMarker(shop)
      })

    },
    createMarker(data) {
      var marker = new tt.Marker()
          .setLngLat([data.coordinates[0], data.coordinates[1]])
          // .setPopup(new tt.Popup({offset: 35})
          //     .setHTML(data.address))
          .addTo(this.map);

      marker._element.addEventListener('click',() => {
        this.setChosenShop(data.id)
      })

      this.markers.push(marker)
    },
  },

  async mounted() {
    this.initializeMap()
  },

  computed: {
    shops() {
      return this.$store.getters['shops/shops'];
    },
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