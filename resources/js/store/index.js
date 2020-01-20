import Vue from 'vue';
import Vuex from 'vuex';
import roles from './modules/roles'
import permissions from "./modules/permissions";
import statuses from "./modules/statuses";
import categories from "./modules/categories";
import types from "./modules/types";
import incidents from "./modules/incidents";

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        roles,
        permissions,
        statuses,
        categories,
        types,
        incidents
    }
})
