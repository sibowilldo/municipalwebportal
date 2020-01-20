import axios from 'axios';

const state = {
    permissions: []
};

const getters = {
    getPermissions: (state) => state.permissions
};

const actions = {
    async FETCH_PERMISSIONS ({ commit }){
        const response = await axios.get('/api/v1/permissions');
        commit('setPermissions', response.data.permissions);
    }
};

const mutations = {
    setPermissions: (state, permissions) => (state.permissions = permissions)
};

export default {
    state,
    getters,
    actions,
    mutations
}
