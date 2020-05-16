<style scoped>

</style>
<template>
  <v-card class="mx-auto pa-5" min-height="500px" min-width="500px" rasied>
    <v-row justify="space-around">
      <v-col class="d-flex" cols="12" sm="6">
        <v-select
          v-model="val"
          :items="items"
          label="Select priority"
          return-object
        ></v-select>
      </v-col>
    </v-row>

    <v-card-actions class="justify-end">
      <v-btn 
        depressed 
        color="primary" 
        @click="$emit('priority-selected', val)"
      >
        NEXT <v-icon right>mdi-arrow-right</v-icon>
      </v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
export default {
  name: 'PrioritySelect',
  data() {
    return {
      val: 'close',
      items: [
        {
          text: 'Proximity to my location',
          value: 'close'
        },
        {
          text: 'Sheltered from the wind',
          value: 'sheltered'
        },
        {
          text: 'Best chance of a fish',
          value: 'fish'
        },
        {
          text: 'The spot has water',
          value: 'none'
        },
      ]
    }
  }
}
</script>
