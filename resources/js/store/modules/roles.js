import axios from 'axios';

const state = {
    roles: [],
    guards: [],
    guard:'',
    permissions:[],
    errors: {
        message: null,
        errors: {
            name: []
        }
    }
};

const getters = {
    getRoles: (state) => state.roles,
    getGuards: (state) => state.guards,
    getErrors: (state) => state.errors
};

const actions = {
    async FETCH_ROLES ({ commit }){
        await axios.get('/api/v1/roles')
            .then((response)=>{
                commit('SET_ROLES', response.data.roles);
                commit('SET_GUARDS', response.data.guards);
        });
    },
    async ADD_ROLE ({commit},payload){
        await axios.post('/api/v1/roles', payload)
            .then((response)=> {
                commit('NEW_ROLE', response.data);
                commit('SET_ERRORS', {
                    message: null,
                    errors: {
                        name: []
                    }
                });
            })
            .catch((error)=>{
                commit('SET_ERRORS', error.response.data);
            });
    }
};

const mutations = {
    SET_ROLES: (state, roles) => (state.roles = roles),
    SET_GUARDS: (state, guards) => (state.guards = guards),
    SET_ERRORS: (state, errors) => (state.errors = errors),
    NEW_ROLE:(state, role)=> (state.roles.unshift(role))
};

export default {
    state,
    getters,
    actions,
    mutations
}
