<style scoped>

</style>
<template>
  <div class="homepage-container">
    <v-container v-if="preferences" fluid class="text-center mx-auto" style="max-width:1633px">
      <!-- Current Preferences -->
      <v-row class="my-4">
        <v-expansion-panels>
          <v-expansion-panel>
            <v-expansion-panel-header>Current Preferences</v-expansion-panel-header>
            <v-expansion-panel-content>
              <v-col>
                <v-row><v-icon>mdi-calendar-month</v-icon> Date & Time: &nbsp;<strong> {{$moment(preferences.time).format("dddd, MMMM Do YYYY, h:mm:ss a")}}</strong></v-row>
                <v-row><v-icon>mdi-water</v-icon> Water Type: &nbsp;<strong> {{preferences.water.type.toUpperCase()}}WATER <span v-if="preferences.water.bay">({{preferences.water.bay.toUpperCase()}})</span></strong></v-row>
                <v-row>
                  <v-icon>mdi-target</v-icon> Target Species: &nbsp;
                  <strong>
                    <span v-if="preferences.species.length === speciesList.length">All Species </span>
                    <span v-else
                      v-for="(s, i) in species" 
                      :key="s.name"
                    >
                      {{s.name}} <span v-if="(i + 1) !== preferences.species.length">, </span>
                    </span>
                  </strong>
                </v-row>
                <v-row>
                  <v-icon>mdi-map-marker</v-icon> Location: &nbsp;<strong> Less than {{preferences.location.distance}}km from {{preferences.location.loc.name}}</strong></v-row>
                <v-row><v-icon>mdi-account</v-icon> Priority: &nbsp;<strong>{{preferences.priority.text}}</strong></v-row>

                <v-row class="justify-end">
                  <v-btn depressed color="primary" href="/preferences">Chane Preferences</v-btn>
                </v-row>
              </v-col>
            </v-expansion-panel-content>
          </v-expansion-panel>
        </v-expansion-panels>
      </v-row>

      <v-row>
        <v-col sm="12" md="6">
          <h2>Spot Recommendations</h2>
          <SpotsList :spots="spots"/>
        </v-col>
        <v-col sm="12" md="6">
          <h2>Weather Now</h2>
          <v-row class="justify-space-around">
            <WeatherCard v-for="(area, i) in areas" :key="'area-'+i" class="col-sm-12 col-lg-6" :area="area"/>
          </v-row>
        </v-col>
      </v-row>
      
    </v-container>
  </div>
</template>

<script>
  import SpotsList from '../common/SpotsList'
  import WeatherCard from '../common/WeatherCard'

  export default {
    components: {
      SpotsList,
      WeatherCard
    },
    props: {
      spots: {},
      speciesList: {},
    },
    name: 'Dashboard',
    data() {
      return {
        preferences: null,
        areas: [],
      }
    },
    mounted() {
      if(localStorage.getItem('ff-prefs')) {
        this.preferences = JSON.parse(localStorage.getItem('ff-prefs'));
        if(this.preferences.water.type == 'salt') {
          this.areas = [
            {
              selected: this.preferences.water.bay === 'wp',
              name: 'Westernport West',
              id: '13838'
            },
            {
              selected: this.preferences.water.bay === 'wp',
              name: 'Westernport East',
              id: '12383'
            },
            {
              selected: this.preferences.water.bay === 'ppb',
              name: 'Port Phillip Bay',
              id: '13856',
            },
          ]
        } else {
          // WeatherCard for selected Location TODO
        }
      } else {
        window.location.href = '/preferences'
      }
    }
  }
</script>
