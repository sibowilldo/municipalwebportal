import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import App from './components/App'
import Welcome from './components/Welcome'

import Login from './components/auth/Login'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Welcome
        },
        {
            path: '/login',
            name: 'login',
            component: Login
        },
    ],
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});