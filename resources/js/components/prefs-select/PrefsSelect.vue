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
    <TimeSelect v-if="step == 0"/>
  </div>
</template>

<script>
import TimeSelect from './TimeSelect'
import ComfortSelect from './ComfortSelect'
import WaterSelect from './WaterSelect'
import SpeciesSelect from './SpeciesSelect'

export default {
  components: {
    TimeSelect,
    ComfortSelect,
    WaterSelect,
    SpeciesSelect,
  },
  name: 'PrefsSelect',
  props: {
    speciesList: {},
  },
  data() {
    return {
      step: 0,
      time: this.$moment.now(),
      comfort: null,
      water: null,
      species: [],
    }
  }
}
</script>
