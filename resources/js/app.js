/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


require('./bootstrap');
require('simplelightbox');

window.Vue = require('vue');


import VueAxios from 'vue-axios';
import Notify from 'vue2-notify';
import 'chart.js';
import Vuelidate from "vuelidate";

// Use Notify
Vue.use(Notify, {
    position: 'top-right',
    leave: 'fadeOut',
    closeButtonClass: 'close',
    visibility: 5000,
    mode: 'html'
});
// define notify types
const types = {
    info:       {itemClass:'alert-info m-alert', iconClass: 'icon la la-info-circle', },
    error:      {itemClass:'alert-error m-alert', iconClass: 'icon la la-times-circle' },
    warning:    {itemClass:'alert-warning m-alert', iconClass: 'icon la la-exclamation-circle' },
    success:    {itemClass:'alert-success m-alert', iconClass: 'icon la la-check-circle' }
};
// Set notify type
Vue.$notify.setTypes(types);
// Use Axios
Vue.use(VueAxios, axios);
// use vuelidate
Vue.use(Vuelidate);
/**
 * Load Components
 */
import TypesChart from './components/dashboard/TypesChart';
import StatusesChart from './components/dashboard/StatusesChart';
import IncidentsChart from './components/dashboard/IncidentsChart';
import RolesCreate from './components/roles/create';

/**
 * Import the store
 */
import store from '../js/store';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    store: store,
    components: {
        TypesChart,
        StatusesChart,
        IncidentsChart,
        RolesCreate
    }
});
