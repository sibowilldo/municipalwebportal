let mutations = {
    ADD_STATUS(state, status){
        state.statuses.unshift(status)
    },
    GET_STATUSES(state, statuses){
        state.statuses = statuses
        console.log(state.statuses)
    }
}

export default mutations
