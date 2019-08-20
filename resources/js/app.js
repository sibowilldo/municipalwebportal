
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

// import axios from 'axios'
import VueAxios from 'vue-axios'

Vue.use(VueAxios, axios)

import 'chart.js';

/**
 * Load Components
 */
import TypesChart from './components/dashboard/TypesChart'
import StatusesChart from './components/dashboard/StatusesChart'
import IncidentsChart from './components/dashboard/IncidentsChart'
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    components: {
        TypesChart,
        StatusesChart,
        IncidentsChart
    }
});
