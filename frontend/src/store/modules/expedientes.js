import axios from "axios";
import router from "../../router";

const state = {
    //Arrays
    todos_expedientes: [],
    expedientes: [],
    historial: [],
    resultado:  [],
    expedientes_subsidio: [],

    //Estado (finalizado)
    finalizado: false,
    aceptado: false,
    encontrado: false,
    show_modal_tomar_exp: false,
};

const getters = {
    get_todos_expedientes: state => state.todos_expedientes,
    get_expedientes: state => state.expedientes,
    get_finalizado: state => state.finalizado,
    get_historial: state => state.historial,
    get_aceptado: state => state.aceptado,
    get_encontrado: state => state.encontrado,
    get_resultado: state => state.resultado,
    get_subsidio_expedientes: state => state.expedientes_subsidio,
    get_show_modal_tomar_exp: state => state.show_modal_tomar_exp,
}

const actions = {

    //muestra el detalle en la linea del tiempo - seguimiento
    historial_expediente ({commit}, expediente) {
        axios.post(process.env.VUE_APP_API_URL+ '/api/historialExp', expediente)
            .then(response => {
                commit('set_historial', response.data)
                router.push('/ver-historiales');
            })
    },

    // muestra todos los expedientes
    todosExpedientes ({commit}) {
        axios.get(process.env.VUE_APP_API_URL+ '/api/all-expedientes')
            .then(response => {
                commit('set_todos_expedientes', response.data)
                commit('set_todos_expedientes', response.data)
                commit('set_finalizado', false)
            })
    },

    //Cambia de acuerdo al nro de bandeja que le pase
    // Bandeja de Entrada: 1
    // Mis expedientes: 3
    // Recuperar / Enviados que todavia no han sido aceptados: 4
    listadoExpedientes ({ commit }, expediente) {
        axios.post(process.env.VUE_APP_API_URL+ '/api/ListadoExp', expediente)
            .then(response => {
                commit('set_expedientes', response.data)
                commit('set_finalizado', false)
            })
    },

    cambiarEstado ({commit}, expediente) {
        axios.post(process.env.VUE_APP_API_URL+ '/api/update-estado', expediente).
        then(response => {
            commit('set_expedientes', response.data)
            commit('set_aceptado', true)
        })
    },

    consultarExpediente ({ commit }, busqueda) {
        axios.post(process.env.VUE_APP_API_URL+ '/api/buscar-expediente', busqueda)
            .then(response => {
                commit('set_resultados', response.data)
                commit('set_encontrado', true)
            })
            .catch( () => {
            })
    },

    //muestra todos los expedientes con motivo de tramite subsidio
    listadoMotivoSubsidio({commit}){
        axios.post(process.env.VUE_APP_API_URL+ '/api/expSubsidiosNoReintegrables')
            .then(response => {
                commit('set_subsidio_expedientes', response.data)
                commit('set_finalizado', false)
            })
    },

    historial_enviados ({ commit }, all) {
        axios.get(process.env.VUE_APP_API_URL+ '/api/mis-enviados', all)
            .then(response => {
                commit('set_expedientes', response.data)
                commit('set_finalizado', false)
            })
    },

    tomarExpediente ({commit}, expediente) {
        axios.post(process.env.VUE_APP_API_URL+ '/api/regresar', expediente).
        then(response => {
            commit('set_expedientes', response.data)
            commit('set_aceptado', true)
            commit('set_show_modal_tomar_exp', false)
        })
    },

    showModalTomarExp ({commit}, modal) {
        commit('set_show_modal_tomar_exp', modal)
    }
}

const mutations = {
    set_todos_expedientes: (state, todos_expedientes) => state.todos_expedientes = todos_expedientes,
    set_expedientes: (state, expedientes) => state.expedientes = expedientes,
    set_finalizado: (state, finalizado) => state.finalizado = finalizado,
    set_historial: (state,historial) => state.historial = historial,
    set_aceptado: (state,aceptado) => state.aceptado = aceptado,
    set_resultados: (state, resultado) => state.resultado = resultado,
    set_encontrado: (state, encontrado) => state.encontrado = encontrado,
    set_subsidio_expedientes: (state, expedientes_subsidio) => state.expedientes_subsidio = expedientes_subsidio,
    set_show_modal_tomar_exp: (state, show_modal_tomar_exp) => state.show_modal_tomar_exp = show_modal_tomar_exp,
}

export default {
    namespace: true,
    state,
    getters,
    actions,
    mutations
}
