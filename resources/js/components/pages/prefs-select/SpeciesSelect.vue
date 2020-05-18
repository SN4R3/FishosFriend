<style scoped>

</style>
<template>
  <v-card class="mx-auto pa-5" min-height="500px" min-width="500px" rasied>
    <v-row justify="space-around">
      <v-col>
        <v-checkbox v-model="all" label="Anything"></v-checkbox>
        <v-combobox
          v-model="species"
          :items="filteredSpecies"
          label="Select your target species"
          :disabled="all"
          multiple
        ></v-combobox>
      </v-col>
    </v-row>

    <v-card-actions class="justify-end">
      <v-btn 
        depressed 
        color="primary" 
        @click="$emit('species-selected', all ? filteredSpecies : species)"
      >
        NEXT <v-icon right>mdi-arrow-right</v-icon>
      </v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
export default {
  name: 'SpeciesSelect',
  props: {
    waterType: {},
    allSpecies: {},
  },
  data() {
    return {
      all: true,
      species: [],
    }
  },
  computed: {
    filteredSpecies: function() {
      let res = []
      this.allSpecies.forEach((spec) => {
        let copy = JSON.parse(JSON.stringify(spec))
        copy.text = spec.name
        copy.value = spec
        // filter out species by selected watertype TODO
        res.push(copy)
      })

      return res
    }
  }
}
</script>
