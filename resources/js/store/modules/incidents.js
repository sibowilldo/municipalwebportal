import axios from 'axios';

const state = {
    incidents: [],
    errors:[]
};

const getters = {
    getIncidents: (state) => state.incidents,
    getIncidentErrors: (state) => state.errors
};

const actions = {
    async FETCH_INCIDENTS ({ commit }){
        await axios.get('/api/v1/incidents')
            .then(response=>{
                commit('setIncidents', response.data.data);
            });
    },
    async SAVE_INCIDENT ({commit},payload){
        await axios.post('/api/v1/incidents', payload)
            .then(response => {
                commit('addIncident', response.data.data)
            })
            .catch(error => {
                return Promise.reject(error);
            });
    }
};

const mutations = {
    setIncidents: (state, incidents) => (state.incidents = incidents),
    setIncidentErrors: (state, error) => (state.errors = error),
    addIncident: (state, incident) => {
        state.incidents.push(incident)
    }
};

export default {
    state,
    getters,
    actions,
    mutations
}
