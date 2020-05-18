<style scoped>

</style>
<template>
  <v-card class="mx-auto pa-5" min-height="500px" min-width="500px" rasied>
    <v-row justify="center">
      <v-autocomplete
        v-model="loc"
        :items="items"
        :loading="loading"
        outlined
        :search-input.sync="search"
        auto-select-first
        hide-no-data
        label="Search by Postcode"
        placeholder="Eg. '3201'"
        prepend-icon="mdi-map-marker"
        return-object
      ></v-autocomplete>
    </v-row>

    <v-row justify="center">
      <v-card-title v-if="loc"><v-icon right color="red">mdi-map-marker</v-icon> {{loc.text}}</v-card-title>
    </v-row>

    <v-row v-if="loc" justify="center">
      <v-col class="pr-4">
        <v-subheader>Set maximum distance from {{loc.text}} (in km)</v-subheader>
        <v-slider
          v-model="distance"
          class="align-center"
          :max="100"
          :min="5"
          hide-details
        >
          <template v-slot:append>
            <v-text-field
              v-model="distance"
              class="mt-0 pt-0"
              hide-details
              single-line
              type="number"
              style="width: 60px"
            ></v-text-field>
          </template>
        </v-slider>
      </v-col>
    </v-row>

    <v-card-actions class="justify-end">
      <v-btn 
        depressed 
        color="primary" 
        @click="$emit('location-selected', {loc, distance})"
      >
        NEXT <v-icon right>mdi-arrow-right</v-icon>
      </v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
export default {
  name: 'LocationSelect',
  data() {
    return {
      loc: null,
      search: null,
      entries: [],
      loading: false,
      key: 'AIzaSyAziJQPTkya7m0pUOOHEHpZNjHKtCZPjS0',
      distance: 10,
    }
  },
  computed: {
    items() {
      return this.entries.map((r) => {
        r.text = r.name + ' ' + r.postcode
        r.value = r.postcode
        return r
      })
    }
  },
  watch: {
    search(val) {
      if(this.loading) return

      this.entries = []
      if(!val || val.length !== 4) return

      this.loading = true
      axios.get('/api/searchPostcode?postcode='+val).then(res => {
        this.entries = res.data
        this.loading = false
      })
    }
  }
}
</script>
