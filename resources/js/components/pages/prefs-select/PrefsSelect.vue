<style scoped>
  .prefs-select-container {
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
  }
</style>
<template>
  <div class="prefs-select-container">

    <v-stepper v-model="step" vertical non-linear>
      <v-stepper-step :complete="step > 1" step="1" editable>
        Select a Date & Time
      </v-stepper-step>

      <v-stepper-content step="1">
        <TimeSelect @time-selected="timeSelected"/>
      </v-stepper-content>

      <v-stepper-step :complete="step > 2" step="2" editable>Select Water Type & Bay</v-stepper-step>

      <v-stepper-content step="2">
        <WaterSelect @water-selected="waterSelected"/>
      </v-stepper-content>

      <v-stepper-step :complete="step > 3" step="3" editable>Select your Target Species</v-stepper-step>

      <v-stepper-content step="3">
        <SpeciesSelect @species-selected="speciesSelected" :water-type="water" :all-species="speciesList"/>
      </v-stepper-content> 

      <v-stepper-step :complete="step > 4" step="4" editable>Select a Location</v-stepper-step>

      <v-stepper-content step="4">
        <LocationSelect @location-selected="locationSelected"/>
      </v-stepper-content> 

      <v-stepper-step :complete="step > 5" step="5" editable>Select a Priority</v-stepper-step>

      <v-stepper-content step="5">
        <PrioritySelect @priority-selected="prioritySelected"/>
      </v-stepper-content> 

      <v-stepper-step :complete="step > 6" step="6">Confirm Preferences</v-stepper-step>

      <v-stepper-content step="6">
        <v-col>
          <v-row v-if="step == 6"><v-icon>mdi-calendar-month</v-icon> Date & Time: &nbsp;<strong> {{time.format("dddd, MMMM Do YYYY, h:mm:ss a")}}</strong></v-row>
          <v-row v-if="step == 6"><v-icon>mdi-water</v-icon> Water Type: &nbsp;<strong> {{water.type.toUpperCase()}}WATER <span v-if="water.bay">({{water.bay.toUpperCase()}})</span></strong></v-row>
          <v-row v-if="step == 6">
            <v-icon>mdi-target</v-icon> Target Species: &nbsp;
            <strong>
              <span v-if="species.length === speciesList.length">All Species </span>
              <span v-else
                v-for="(s, i) in species" 
                :key="s.name"
              >
                {{s.name}} <span v-if="(i + 1) !== species.length">, </span>
              </span>
            </strong>
          </v-row>
          <v-row v-if="step == 6">
            <v-icon>mdi-map-marker</v-icon> Location: &nbsp;<strong> Less than {{location.distance}}km from {{location.loc.name}}</strong></v-row>
          <v-row v-if="step == 6"><v-icon>mdi-account</v-icon> Priority: &nbsp;<strong>{{priority.text}}</strong></v-row>

          <v-row class="justify-end">
            <v-btn depressed color="primary" @click="savePreferences">Save Preferences</v-btn>
          </v-row>
        </v-col>
      </v-stepper-content> 
    </v-stepper>
  </div>
</template>

<script>
import TimeSelect from './TimeSelect'
import PrioritySelect from './PrioritySelect'
import WaterSelect from './WaterSelect'
import SpeciesSelect from './SpeciesSelect'
import LocationSelect from './LocationSelect'

export default {
  components: {
    TimeSelect,
    PrioritySelect,
    WaterSelect,
    SpeciesSelect,
    LocationSelect,
  },
  name: 'PrefsSelect',
  props: {
    speciesList: {},
  },
  data() {
    return {
      time: this.$moment(),
      priority: null,
      water: null,
      species: [],
      location: null,
    }
  },
  mounted() {
    if(localStorage.getItem('ff-prefs')) {
      let { step, time, priority, water, species, location } = JSON.parse(localStorage.getItem('ff-prefs'));
      this.step = step
      this.time = time
      this.priority = priority
      this.water = water
      this.species = species
      this.location = location
    }
  },
  methods: {
    savePreferences() {
      localStorage.setItem('ff-prefs', JSON.stringify({
        time: this.time,
        priority: this.priority,
        water: this.water,
        species: this.species,
        location: this.location,
      }))
      window.location.href = '/'
    },
    waterSelected(water) {
      this.water = water
      this.step++;
    },
    timeSelected(dateTime) {
      this.time = dateTime
      this.step++;
    },
    speciesSelected(species) {
      this.species = species
      this.step++
    },
    prioritySelected(priority) {
      this.priority = priority
      this.step++
    },
    locationSelected(location) {
      this.location = location
      this.step++
    }
  }
}
</script>
