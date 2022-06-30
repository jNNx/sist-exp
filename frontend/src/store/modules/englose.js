import axios from "axios";

const state = {
    areas: [],
    exp_englose: '',
    
    consul_loading: false,
    show_englose: false,
};

const getters = {
    get_englose: state => state.exp_englose,

    get_consul_loading: state => state.consul_loading,
    get_show_englose: state => state.show_englose,
};

const actions = {
    englosar ({ commit } , expediente) {
        commit('set_consul_loading', true)
        axios.post(process.env.VUE_APP_API_URL+ '/api/unionExp', expediente)
            .then(response => {
                commit('set_areas', response)
                commit('set_englose', response)
                commit('set_consul_loading', false)
                commit('set_show_englose', true)
            })
    },
};

const mutations = {
    set_areas: (state, areas) => state.areas = areas,
    set_englose: (state, exp_englose) => state.exp_englose = exp_englose,

    set_consul_loading: (state, consul_loading) => state.consul_loading = consul_loading,
    set_show_englose: (state, show_englose) => state.show_englose = show_englose
};

export default {
    namespace: true,
    state,
    getters,
    actions,
    mutations
}
