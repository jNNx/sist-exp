import axios from "axios";
import router from "../../router";

const state = {
    cantidad_subsidioAporteNR: 0,
    cantidad_pendientes: 0,
    subsidioAporteNR:false,
    estado_notificacion: false,
};


const getters = {
    get_cantPendientes: state => state.cantidad_pendientes,
    getcantidad_subsidioAporteNR: state => state.cantidad_subsidioAporteNR,
    get_subsidioAporteNR: state => state.subsidioAporteNR.estado,
    get_estado_notificacion: state => state.estado_notificacion,
};


const actions = {
    exp_subsidioAporteNR ({ commit }) {
        axios.get(process.env.VUE_APP_API_URL+ '/api/notificacion')
            .then(response => {
                commit('set_expSubsidioAporteNR', response.data)
                if(response.data.estado === 1 ) {
                    commit('set_estado_notificacion', true)
                }
            })
    },

    exp_subsidioLeido ({ commit }) {
        axios.get(process.env.VUE_APP_API_URL+ '/api/notificacion-cerrar')
            .then(response => {
                commit('set_estado_notificacion', false)
                commit('set_expSubsidioAporteNR', response.data)
                router.push('/expedientes-subsidios');
            })
    },

    cantidadPendientes ({ commit }, usuario) {
        axios.get(process.env.VUE_APP_API_URL+ '/api/contarExp', usuario)
            .then(response => {
                commit('set_cantPendientes', response.data)
            })
    },
};

const mutations = {
    setcantidad_subsidioAporteNR: (state, cantidad_subsidioAporteNR) => state.cantidad_subsidioAporteNR = cantidad_subsidioAporteNR,
    set_cantPendientes: (state, cantidad_pendientes) => state.cantidad_pendientes = cantidad_pendientes,
    set_expSubsidioAporteNR: (state, subsidioAporteNR) => state.subsidioAporteNR = subsidioAporteNR,
    set_estado_notificacion: (state, estado_notificacion) => state.estado_notificacion = estado_notificacion,
};


export default {
    namespace: true,
    state,
    getters,
    actions,
    mutations
}
