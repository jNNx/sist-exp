import axios from "axios";

const state = {
    areas: [],
};

const getters = {
    allAreas: state => state.areas
};

const actions = {
    getAreas ({ commit } , expediente) {
        axios.post(process.env.VUE_APP_API_URL+ '/api/historial', expediente)
            .then(response => {
                let areas = response.data[1];
                commit('set_areas', areas)
            })
    },
};

const mutations = {
    set_areas: (state, areas) => state.areas = areas,
};

export default {
    namespace: true,
    state,
    getters,
    actions,
    mutations
}
