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
        const response = await axios.get('/api/v1/incidents');
        commit('setIncidents', response.data.data);
    },
    SAVE_INCIDENT : async  (context, payload) => {
        await axios.post('/api/v1/incidents', payload)
            .then(response => {
                console.info('incidents.js', response.data.incident);
                // context.commit('addIncident', response.data.incident)
            })
            .catch(error => {
                return Promise.reject(error);
            });
    }
};

const mutations = {
    setIncidents: (state, incidents) => (state.incidents = incidents),
    setIncidentErrors: (state, error) => (state.errors = error),
    addIncident: (state, incident) => ( state.incidents.push(incident))
};

export default {
    state,
    getters,
    actions,
    mutations
}
