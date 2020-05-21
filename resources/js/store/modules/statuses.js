import axios from 'axios';

const state = {
    statuses: []
};

const getters = {
    getStatuses: (state) => state.statuses,
    getStatus: (state) => (id) => { return state.statuses.find(status => status.id === id) },
    getIncidentStatuses: (state) => { return state.statuses.filter(status => status.model_type === 'App\\Incident')}
};

const actions = {
    async FETCH_STATUSES ({ commit }){
        await axios.get('/api/v1/statuses').then( response =>{
            commit('setStatuses', response.data.data);
        });
    }
};

const mutations = {
    setStatuses: (state, statuses) => (state.statuses = statuses)
};

export default {
    state,
    getters,
    actions,
    mutations
}
