import axios from 'axios';

const state = {
    types: []
};

const getters = {
    getTypes: (state) => state.types
};

const actions = {
    async FETCH_PERMISSIONS ({ commit }){
        const response = await axios.get('/api/v1/types');
        commit('setTypes', response.data.types);
    }
};

const mutations = {
    setTypes: (state, types) => (state.types = types)
};

export default {
    state,
    getters,
    actions,
    mutations
}
