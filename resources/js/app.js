require('./bootstrap');
import Vue from 'vue';
import vuetify from './plugins/vuetify' // path to vuetify export

const moment = require('moment');
moment.locale('au');

Vue.prototype.$moment = moment

import NavBar from './components/layout/NavBar'
import PrefsSelect from './components/prefs-select/PrefsSelect'

const app = new Vue({
  el: '#app',
  vuetify,
  components: {
    NavBar,
    PrefsSelect
  },
})