import axios from "axios";
import router from "../../router";

const state = {
    expedientes:[] ,
    fecha: '',
    areas: [],
    expediente: [],
    exitopase: false,
    areas_mesa_archivos:[],

    pase_aerror: '',
    aafectetosde_error: '',
    nrofojas_error: '',
};

const getters = {
    expedientePase: state => state.expedientes,
    idExpedientePase: state => state.expedientes.id,
    get_areas: state => state.areas,
    get_areas_mesa_archivos: state => state.areas_mesa_archivos,
    fechaPase: state => state.fecha,
    expediente_exito: state => state.expediente,
    creado_exito:state => state.exitopase,

    pasea_error: state => state.pase_aerror,
    a_afectosde_error: state => state.aafectetosde_error,
    nrofojas_error: state => state.nrofojas_error,
 };

const actions = {

    getNuevoPase ({ commit }, expediente )  {
        axios.post(process.env.VUE_APP_API_URL+ '/api/historial', expediente)
            .then(response => {
                commit('set_expedientes', response.data[0])
                commit('set_fecha',response.data[2])
                commit('set_areas',response.data[3])
                commit('set_areas_mesa_archivos', response.data[1])
                router.push('/nuevo-pase');
            })
    },

    storePase ({ commit }, expediente) {
        axios.post(process.env.VUE_APP_API_URL+ '/api/historial-expediente', expediente).
        then(response => {
            commit('save_newPase', response.data)
            commit('set_creado', true)
        })
        .catch(error => {
            commit('set_a_afectos_de_error', error.response.data.errors.motivo[0])
            commit('set_nrofojas_error', error.response.data.errors.fojas[0])
        })
    },

    cerrarModal ({ commit }){
        commit('set_creado',false)
    },
};

const mutations = {
    set_expedientes: (state, expedientes) => state.expedientes = expedientes,
    set_fecha: (state, fecha) => state.fecha = fecha,
    set_areas: (state, areas) => state.areas = areas,
    save_newPase: (state, expediente) => state.expediente = expediente,
    set_creado: (state, exitopase) => state.exitopase = exitopase,

    set_pasea_error: (state, pase_aerror) => state.pase_aerror = pase_aerror,
    set_a_afectos_de_error: (state, aafectetosde_error) => state.aafectetosde_error = aafectetosde_error,
    set_nrofojas_error: (state, nrofojas_error) => state.nrofojas_error = nrofojas_error,
    set_areas_mesa_archivos: (state, areas_mesa_archivos) => state.areas_mesa_archivos = areas_mesa_archivos,
};

export default {
    namespace: true,
    state,
    getters,
    actions,
    mutations
}




