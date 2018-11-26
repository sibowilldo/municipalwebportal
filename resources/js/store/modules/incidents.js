import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'
import VueAxios from 'vue-axios'

Vue.use(Vuex)
Vue.use(VueAxios, axios)

export default new Vuex.Store({
    state:{
        incidents:[]
    },
    actions:{
        allIncidents ({ commit }){
            axios
                .get('/api/auth/incidents')
                .then(response => response.data)
                .then(incidents => {
                    console.log(incidents)
                    // commit('set_incidents', incidents)
                })
        }
    },
    mutations:{
        set_incidents(state, incidents){
            state.incidents = incidents
        }
    }
});

// export default IncidentStore;