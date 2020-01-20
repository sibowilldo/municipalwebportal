import axios from 'axios';

const state = {
    categories: []
};

const getters = {
    getCategories: (state) => state.categories
};

const actions = {
    async FETCH_CATEGORIES ({ commit }){
        const response = await axios.get('/api/v1/categories');
        commit('setCategories', response.data.data);
    }
};

const mutations = {
    setCategories: (state, categories) => (state.categories = categories)
};

export default {
    state,
    getters,
    actions,
    mutations
}
