require('./bootstrap')
import Vue from 'vue'
import VueRouter from 'vue-router'
import router from './routes'
import store from './store/store'

import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css' // set language to EN
import lang from 'element-ui/lib/locale/lang/en'
import locale from 'element-ui/lib/locale'

locale.use(lang)
Vue.use(ElementUI)

Vue.use(VueRouter)
Vue.use(require('vue-moment'))

const app = new Vue({
    el: '#app',
    store,
    router,
});