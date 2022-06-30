import axios from "axios";

const state = {
    expedientesPadre: [],

    expedientePadreSeleccionado:[],
    expedientesHijos: [],
    exp_desglose: '',

    consulta_loading: false,
    show_desglose: false,
};

const getters = {
    getExpedientesHijos: state => state.expedientesHijos,
    getExpedientesPadres: state => state.expedientesPadre,
    getExpedientesPadresSeleccionados: state => state.expedientePadreSeleccionado,
    get_desglose: state => state.exp_desglose,

    get_consulta_loading: state => state.consulta_loading,
    get_show_desglose: state => state.show_desglose,
};

const actions = {
    desglosarVerPadres ({ commit } , expediente) {
        axios.get(process.env.VUE_APP_API_URL+ '/api/indexExpPadres', expediente)
            .then(response => {
                commit('set_exp_padres', response.data)
            })
    },

    desglosarVerHijos ({ commit } , expediente) {
        commit('set_consulta_loading', true)
        axios.post(process.env.VUE_APP_API_URL+ '/api/createDesgloceExp', expediente)
            .then(response => {
                commit('set_exp_padres_seleccionado', response.data[0])
                commit('set_exp_hijos', response.data[1])
                commit('set_consulta_loading', false)
            })
    },

    desglose ({ commit } , expediente) {
        commit('set_consulta_loading', true)
        axios.post(process.env.VUE_APP_API_URL+ '/api/desgloceExp', expediente)
            .then(response => {
                commit('set_desglose', response)
                commit('set_consulta_loading', false)
                commit('set_show_desglose', true)
            })
 
    },
};

const mutations = {
    set_exp_hijos: (state, expedientesHijos) => state.expedientesHijos = expedientesHijos,
    set_exp_padres: (state, expedientesPadre) => state.expedientesPadre = expedientesPadre,
    set_exp_padres_seleccionado: (state, expedientePadreSeleccionado) => state.expedientePadreSeleccionado = expedientePadreSeleccionado,
    set_desglose: (state, exp_desglose) => state.exp_desglose = exp_desglose,

    set_consulta_loading: (state, consulta_loading) => state.consulta_loading = consulta_loading,
    set_show_desglose: (state, show_desglose) => state.show_desglose = show_desglose
};

export default {
    namespace: true,
    state,
    getters,
    actions,
    mutations
}
