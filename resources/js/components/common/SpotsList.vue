<style scoped>

</style>
<template>
  <v-row class="spots-container justify-space-around">
    <v-card
      v-for="spot in spots"
      :key="'spot-'+spot.id"
      class="mx-auto my-4 col-sm-12 col-lg-6 d-table"
      max-width="374"
    >
      <v-img
        height="250"
        src="https://cdn.vuetifyjs.com/images/cards/cooking.png"
      ></v-img>

      <v-card-title>{{spot.name}}</v-card-title>

      <v-card-text>
        <div class="my-4 subtitle-1">
          <v-icon>mdi-map-marker</v-icon> 34 KM away
        </div>

        <div v-html="spot.info"></div>

        <br/>

        <div><v-icon>mdi-weather-windy</v-icon> Sheltered from Wind</div>
        <div v-if="spot.toilets"><v-icon>mdi-paper-roll</v-icon> Toilets</div>
      </v-card-text>

      <v-divider class="mx-4"></v-divider>

      <v-card-title>Species Available</v-card-title>

      <v-card-text>
        <v-chip-group
          active-class="primary accent-4 white--text"
          column
        >
          <v-chip v-for="species in spot.species" :key="species.name+'-'+spot.id">{{species.name}}</v-chip>
        </v-chip-group>
      </v-card-text>

      <v-card-actions>
        <v-btn color="primary">
          <v-icon color="white">mdi-map-marker</v-icon> Take Me There
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-row>
</template>

<script>
export default {
  props: {
    spots: {},
  },
  name: 'SpotsList',
  data() {
    return {

    }
  }
}
</script>
