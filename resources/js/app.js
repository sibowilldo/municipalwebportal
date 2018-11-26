require('./bootstrap')
import Vue from 'vue'
import VueRouter from 'vue-router'
import router from './routes'
import store from './store/store'

Vue.use(VueRouter)
Vue.use(require('vue-moment'))

const app = new Vue({
    el: '#app',
    store,
    router,
});