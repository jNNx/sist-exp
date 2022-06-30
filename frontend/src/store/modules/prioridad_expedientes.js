import axios from "axios";

const state = {
    prioridad: [],
};

const getters = {
    allPrioridad: state => state.prioridad
};

const actions = {
    getPrioridad ({ commit })  {
        axios.get(process.env.VUE_APP_API_URL+ '/api/createExp')
            .then(response => {
                let prioridad = response.data[2];
                commit('set_prioridad', prioridad)
            })
    },
};

const mutations = {
    set_prioridad: (state, prioridad) => state.prioridad = prioridad,
};

export default {
    namespace: true,
    state,
    getters,
    actions,
    mutations
}
