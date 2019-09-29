let actions = {
    GET_STATUSES({commit}) {
        axios.get('charts/statuses')
            .then(response => {
                commit('GET_STATUSES', response.data)
            })
    }
}

export default actions
