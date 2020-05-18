<style scoped>

</style>
<template>
  <v-card
    class="my-4"
    :color="area.selected ? 'primary' : ''"
    :dark="area.selected"
    max-width="443px"
  >
    <v-list-item two-line>
      <v-list-item-content>
        <v-list-item-title class="headline">{{area.name}}</v-list-item-title>
        <v-list-item-subtitle>18/05/2020, Now, Mostly Sunny</v-list-item-subtitle>
      </v-list-item-content>
    </v-list-item>

    <v-card-text>
      <v-row align="center">
        <v-col class="display-3" cols="6">
          23&deg;C
        </v-col>
        <v-col cols="6">
          <v-img
            src="https://cdn.vuetifyjs.com/images/cards/sun.png"
            alt="Sunny image"
            width="92"
          ></v-img>
        </v-col>
      </v-row>
    </v-card-text>

    <v-list-item>
      <v-list-item-icon>
        <v-icon>mdi-send</v-icon>
      </v-list-item-icon>
      <v-list-item-subtitle>23 km/h</v-list-item-subtitle>
    </v-list-item>

    <v-list-item>
      <v-list-item-icon>
        <v-icon>mdi-waves</v-icon>
      </v-list-item-icon>
      <v-list-item-subtitle>High Tide: 13:50, Low tide: 22:50</v-list-item-subtitle>
    </v-list-item>

    <v-divider></v-divider>

    <v-card-actions class="justify-space-between">
      <v-btn text>Spots List</v-btn>
      <v-btn v-if="!area.selected" text primary @click="setBay(area)">Set Bay</v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
export default {
  name: 'WeatherCard',
  props: {
    area: {},
  },
  data() {
    return {

    }
  },
  methods: {
    setBay(area) {
      let prefs = JSON.parse(localStorage.getItem('ff-prefs'));
      prefs.water.bay = area.name == 'Port Phillip Bay' ? 'ppb' : 'wp'
      localStorage.setItem('ff-prefs',JSON.stringify(prefs))
      window.location.reload()
    }
  }
}
</script>
