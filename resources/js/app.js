
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import 'chart.js';

/**
 * Load Components
 */
import ExampleComponent from './components/ExampleComponent'
import TypesChart from './components/dashboard/TypesChart'
import StatusesChart from './components/dashboard/StatusesChart'
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
// Vue.component('example-component', require('./components/ExampleComponent').default);
// Vue.component('types-chart', require('./components/dashboard/TypesChart'));

const app = new Vue({
    el: '#app',
    components: {
        ExampleComponent,
        TypesChart,
        StatusesChart
    }
});
