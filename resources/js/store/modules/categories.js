import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'
import VueAxios from 'vue-axios'

Vue.use(Vuex)
Vue.use(VueAxios, axios)

export default{
    state:{
        categories:[]
    },
    getters: {
        allCategories: state =>{
            return state.categories
        }
    },
    actions:{
        fetchCategories ({ commit }){
            axios
                .get('/api/auth/categories')
                .then(response => response.data)
                .then(categories => {
                    commit('SET_CATEGORIES', categories)
                })
        }
    },
    mutations:{
        SET_CATEGORIES(state, categories){
            state.categories = categories.data
        }
    }
};