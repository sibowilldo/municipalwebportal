import Vue from 'vue';
import Vuex from 'vuex';
import roles from './modules/roles'
import permissions from "./modules/permissions";

Vue.use(Vuex);

export default new Vuex.Store({
    modules:{
        roles,
        permissions
    }
})
