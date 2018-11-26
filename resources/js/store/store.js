import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate'
import axios from 'axios'
import VueAxios from 'vue-axios'
import auth from './modules/auth'
import incidents from './modules/incidents'
import * as Cookies from 'js-cookie'



Vue.use(Vuex);
Vue.use(VueAxios, axios)

const store = new Vuex.Store({

    modules:{
        auth, incidents
    },
    state: { },
    mutations: { },
    actions: { },
    getters: { },
    plugins: [
        createPersistedState({ storage: window.sessionStorage })
    ]
});

export default store;