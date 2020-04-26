require('./bootstrap');
require('simplelightbox');
require('bootstrap-colorpicker');
require('lottie-web');

import '@sweetalert2/theme-material-ui/material-ui.scss';

window.Vue = require('vue');

import * as VueGoogleMaps from 'vue2-google-maps'
import Notify from 'vue2-notify';
import VueAxios from 'vue-axios';
import { BootstrapVue, IconsPlugin } from "bootstrap-vue";
import VueGoodTablePlugin from "vue-good-table";
import Vuelidate from "vuelidate";
import VueRouter from 'vue-router';
import 'chart.js';
import VueEvents from 'vue-events'
import VueSweetalert2 from 'vue-sweetalert2';
import Loading from 'vue-loading-overlay';

/**
 * import styles
 */
import 'bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css';
import 'vue-good-table/dist/vue-good-table.css'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import '../assets/css/app.css'
// import 'sweetalert2/dist/sweetalert2.min.css'

/**
 * Import the store
 */
import store from '../js/store';

/**
 *  Vue.use Plugins
 */
Vue.use(VueRouter);
Vue.use(VueAxios, axios);
Vue.use(Vuelidate);
Vue.use(BootstrapVue);
Vue.use(VueGoodTablePlugin);
Vue.use(VueEvents);
Vue.use(VueGoogleMaps, {
    load: {
        region: 'ZA',
        key: 'AIzaSyAvIMlJTlLmGJL26pLPydvDX0eKduvnXag',
        libraries: 'places'
    },
    installComponents: true
});
Vue.use(Notify, {
    position: 'top-right',
    leave: 'fadeOut',
    closeButtonClass: 'close',
    visibility: 5000,
    mode: 'html'
});
Vue.use(VueSweetalert2);
Vue.use(Loading, {
    backgroundColor:'#000',
    canCancel:true,
    color:'#fff',
    isFullPage:true,
    loader:"dots",
    opacity: 0.9
})
// Initialize notify types
Vue.$notify.setTypes({
    info:       {itemClass:'alert-info m-alert', iconClass: 'icon la la-info-circle', },
    error:      {itemClass:'alert-error m-alert', iconClass: 'icon la la-times-circle' },
    warning:    {itemClass:'alert-warning m-alert', iconClass: 'icon la la-exclamation-circle' },
    success:    {itemClass:'alert-success m-alert', iconClass: 'icon la la-check-circle' }
});

/**
 * Load Components
 */
import Dashboard from './components/home/dashboard';
import TypesChart from './components/dashboard/TypesChart';
import StatusesChart from './components/dashboard/StatusesChart';
import IncidentsChart from './components/dashboard/IncidentsChart';
import RolesCreate from './components/roles/create';
import IncidentCreate from './components/incidents/create';
import IncidentEdit from './components/incidents/edit';
import Multiselect from "vue-multiselect";
import IncidentForm from './components/incidents/form'


/**
 *  Define routes
 */
const routes = [
    {
        path: '/dashboard',
        name: 'dashboard',
        component: Dashboard
    }
];

/**
 *  Initialize router
 */
const router = new VueRouter({routes:routes, mode: 'history'});

require('vue-events');

const app = new Vue({
    el: '#app',
    router: router,
    store: store,
    components: {
        TypesChart,
        StatusesChart,
        IncidentsChart,
        RolesCreate,
        IncidentCreate,
        IncidentEdit,
        Multiselect,
        Dashboard,
        IncidentForm,
        Loading
    }
});
