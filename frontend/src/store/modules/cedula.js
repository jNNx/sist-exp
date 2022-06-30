import axios from "axios";

const state = {
    cedula: [],
    cargado: false,
    error_cedula: [],
    cedulas: [],
    cedula_detalle: [],
    mensaje: false,

    ver_detalle_loading: false,
    show_detalle: false,
};

const getters = {
    get_detalle: state => state.cedula_detalle,
    getCedula: state => state.cedula,
    get_cargado: state => state.cargado,
    get_error: state => state.error_cedula,
    get_cedulas: state => state.cedulas,
    get_mensaje: state => state.mensaje,

    get_detalle_loading: state => state.ver_detalle_loading,
    get_show_detalle: state => state.show_detalle,
};

const actions = {

    verDetalle({commit},expediente_id) {
        commit('set_detalle_loading', true)
        axios
            .post(process.env.VUE_APP_API_URL + '/api/contar-cedula', expediente_id)
            .then((response) => {
                if (response.data.length !== 0){
                    commit('set_cargado', true)
                    commit("set_ceduladetalle", response.data);
                    commit('set_detalle_loading', false)
                    commit('set_show_detalle', true)
                }
                else{
                    commit("set_mensaje", true);
                    commit('set_detalle_loading', false)
                    commit('set_show_detalle', true)
                }
            })
            .catch(error => {
                commit('set_error_cedula', error.response.data.errors.descripcion)
                commit('set_detalle_loading', false)
            })
    },

    storeCedula({commit}, expediente) {
        axios
            .post(process.env.VUE_APP_API_URL + '/api/store-cedula', expediente)
            .then((response) => {
                commit('set_cargado', true)
                commit("set_cedula", response.data[0]);
            })
            .catch(error => {
                commit('set_error_cedula', error.response.data.errors.descripcion)
            })
    },

};

const mutations = {
    set_cedula: (state, cedula) => state.cedula = cedula,
    set_cedulas: (state, cedulas) => state.cedulas = cedulas,
    set_cargado: (state, cargado) => state.cargado = cargado,
    set_error_cedula: (state, error_cedula) => state.error_cedula = error_cedula,
    set_ceduladetalle: (state, cedula_detalle) => state.cedula_detalle = cedula_detalle,
    set_mensaje: (state, mensaje) => state.mensaje = mensaje,

    set_detalle_loading: (state, ver_detalle_loading) => state.ver_detalle_loading = ver_detalle_loading,
    set_show_detalle: (state, show_detalle) => state.show_detalle = show_detalle
};

export default {
    namespace: true,
    state,
    getters,
    actions,
    mutations,
};
