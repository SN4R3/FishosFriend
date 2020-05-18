require('./bootstrap');
import Vue from 'vue';
import vuetify from './plugins/vuetify' // path to vuetify export

const moment = require('moment');
moment.locale('au');

Vue.prototype.$moment = moment

import NavBar from './components/layout/NavBar'
import Dashboard from './components/pages/Dashboard'
import PrefsSelect from './components/pages/prefs-select/PrefsSelect'

const app = new Vue({
  el: '#app',
  vuetify,
  components: {
    NavBar,
    'dash-board': Dashboard,
    PrefsSelect
  },
})