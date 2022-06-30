import axios from "axios";

const state = {
    motivos: [],
};

const getters = {
    allMotivos: state => state.motivos
};

const actions = {
    getMotivos ({ commit })  {
        axios.get(process.env.VUE_APP_API_URL+ '/api/createExp')
            .then(response => {
                let motivo = response.data[1];
                commit('set_motivos', motivo)
            })
    },
};

const mutations = {
    set_motivos: (state, motivos) => state.motivos = motivos,
};

export default {
    namespace: true,
    state,
    getters,
    actions,
    mutations
}
