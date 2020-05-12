<style scoped>

</style>
<template>
  <v-card class="mx-auto pa-5" min-height="500px" min-width="500px" rasied>
    <v-card-title>Select a Date & Time</v-card-title>

    <v-row justify="space-around">
      <v-col>
        <v-date-picker v-model="date" :min="$moment().format('YYYY-MM-DD')" :max="$moment().add(7, 'days').format('YYYY-MM-DD')"/>
      </v-col>
      <v-col>
        <v-time-picker v-model="time" format="24hr"/>
      </v-col>
    </v-row>

    <v-card-actions>
      <v-btn depressed>NEXT <v-icon right>mdi-arrow-right</v-icon></v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
export default {
  name: '',
  data() {
    return {
      date: this.$moment().format('YYYY-MM-DD'),
      time: null,
    }
  },
  computed: {
    dateTime: function() {
      return this.$moment(this.date + ' ' + this.time);
    }
  }
}
</script>
