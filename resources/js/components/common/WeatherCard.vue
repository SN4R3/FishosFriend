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
        <v-list-item-subtitle>{{$moment().format('D/M/yyyy')}} {{overview}}</v-list-item-subtitle>
      </v-list-item-content>
    </v-list-item>

    <v-card-text>
      <v-row align="center">
        <v-col class="display-2" cols="6">
          {{temp}}&deg;C
        </v-col>
        <v-col cols="6">
          <v-img
            :src="img"
            :alt="overview"
            width="92"
          ></v-img>
        </v-col>
      </v-row>
    </v-card-text>

    <v-list-item>
      <v-list-item-icon>
        <v-icon>{{windDirIcon}}</v-icon>
      </v-list-item-icon>
      <v-list-item-subtitle>{{wind}}km/h {{windDir}}</v-list-item-subtitle>
    </v-list-item>

    <v-list-item>
      <v-list-item-icon>
        <v-icon>mdi-waves</v-icon>
      </v-list-item-icon>
      <v-list-item-subtitle>Next High Tide: {{tides.high.time}} ({{tides.high.height}}m)</v-list-item-subtitle>
    </v-list-item>

    <v-list-item>
      <v-list-item-icon>
        <v-icon>mdi-waves</v-icon>
      </v-list-item-icon> 
      <v-list-item-subtitle>Next Low Tide: {{tides.low.time}} ({{tides.low.height}}m)</v-list-item-subtitle>
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
      img: 'https://cdn.vuetifyjs.com/images/cards/sun.png',
      overview: '',
      temp:0,
      wind: 0,
      windDir: '',
      windDirIcon: 'mdi-send',
      tides: {
        high: {
          time: '',
          height: 0
        },
        low: {
          time: '',
          height: 0,
        }
      },
      pressure: {
        num: 0,
        trend: '',
      }
    }
  },
  mounted() {
    axios.get('/api/fetchTodaysWeather?area_id='+this.area.id).then(res => {
      const { weather, tides, wind } = res.data.forecasts;

      let currWeather = weather.days[0].entries[0]
      this.overview = currWeather.precis
      this.img = '/assets/img/weather/'+currWeather.precisCode+'.png';
      this.temp = res.data.observationalGraphs.temperature.dataConfig.series.groups[0].points[res.data.observationalGraphs.temperature.dataConfig.series.groups[0].points.length - 1].y

      // find closests entries to each category

      // tides
      let closestTides = {};
      
      tides.days[0].entries.forEach((entry) => {
        if(this.$moment().isAfter(entry.dateTime)) {
          if(entry.type === 'high') {
            closestTides.high = {
              height: entry.height,
              time: this.$moment(entry.dateTime).format('hh:mm')
            }
          } else {
            closestTides.low = {
              height: entry.height,
              time: this.$moment(entry.dateTime).format('hh:mm')
            }
          }
        }
      })
      
      if(closestTides.high && closestTides.low) {
        this.tides = closestTides
      } else {
        console.log('could not find tides')
      }

      // wind
      let closetWind = null

      wind.days[0].entries.forEach((entry) => {
        if(this.$moment().isAfter(entry.dateTime)) {
          closetWind = {
            wind: entry.speed,
            windDir: entry.directionText
          }
        }
      })

      if(closetWind) {
        this.wind = closetWind.wind
        this.windDir = closetWind.windDir

        switch(this.windDir) {
          case 'N':
            this.windDirIcon = 'mdi-arrow-up-bold-outline'
          break
          case 'NNE':
          case 'NE':
            this.windDirIcon = 'mdi-arrow-bottom-left-bold-outline'
          break;
          case 'E':
            this.windDirIcon = 'mdi-arrow-left-bold-outline'
          break;
          case 'SSE':
          case 'SE':
            this.windDirIcon = 'mdi-arrow-top-left-bold-outline'
          break;
          case 'S':
            this.windDirIcon = 'mdi-arrow-top-bold-outline'
          break;
          case 'SSW':
          case 'SW':
            this.windDirIcon = 'mdi-arrow-top-right-bold-outline'
          break;
          case 'W':
            this.windDirIcon = 'mdi-arrow-right-bold-outline'
          break;
          case 'NNW':
          case 'NW':
            this.windDirIcon = 'mdi-arrow-bottom-right-bold-outline'
          break;
          default:
            this.windDirIcon = 'mdi-send'
          break
        }

      } else {
        console.log('could not find wind')
      }

    })
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
