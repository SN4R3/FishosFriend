<style scoped>

</style>
<template>
  <v-card class="mx-auto pa-5" min-height="500px" min-width="500px" rasied>
    <v-row justify="space-around">
      <v-col>
        <v-radio-group v-model="waterType">
          <v-radio label="Saltwater" value="salt"></v-radio>
          <v-radio label="Freshwater" value="fresh"></v-radio>
        </v-radio-group>
      </v-col>
      <v-col v-show="waterType == 'salt'">
        <v-radio-group v-model="bay">
          <v-radio label="Port Phillip Bay" value="ppb"></v-radio>
          <v-radio label="Westernport Bay" value="wb"></v-radio>
        </v-radio-group>
      </v-col>
    </v-row>

    <v-card-actions class="justify-end">
      <v-btn 
        depressed 
        color="primary" 
        @click="$emit('water-selected', {type:waterType, bay:bay})"
      >
        NEXT <v-icon right>mdi-arrow-right</v-icon>
      </v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
export default {
  name: 'WaterSelect',
  data() {
    return {
      waterType: 'salt',
      bay: 'ppb'
    }
  }
}
</script>
