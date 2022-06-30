import axios from "axios";
import router from "../../router";

const state = {
    tipoEntidad: [],
    iniciador: [],
    listado: [],

    //Modals
    show_modal_edit_iniciador: false,

    //errores
    error_nombre: [],
    error_tipo_entidad: [],
    error_cuit: [],
    error_cuil: [],
    error_telefono: [],
    error_email: [],
    error_direccion: [],
    exito_iniciador: false,
};

const getters = {
    iniciador: state => state.iniciador,
    allTipoEntidad: state => state.tipoEntidad,
    get_tipoSelected: state => state.tipoSelected,
    get_listado: state => state.listado,

    get_show_modal_edit_iniciador: state => state.show_modal_edit_iniciador,

    get_error_nombre: state => state.error_nombre,
    get_error_tipo_entidad: state => state.error_tipo_entidad,
    get_error_cuit: state => state.error_cuit,
    get_error_cuil : state => state.error_cuil,
    get_error_telefono: state => state.error_telefono,
    get_error_email: state => state.error_email,
    get_error_direccion: state => state.error_direccion,
    get_iniciador_creado: state => state.exito_iniciador,
};

const actions = {
    createTipoEntidad ({ commit }) {
        axios.get(process.env.VUE_APP_API_URL+ '/api/createTipoEntidad')
            .then(response => {
                commit('set_tipoSelected', response.data)
            })
    },

    storeIniciador ({ commit }, iniciador)  {
        axios.post(process.env.VUE_APP_API_URL+ '/api/store-iniciador', iniciador)
            .then(response => {
                commit('set_iniciador', response.data)
                commit('set_exito_iniciador', true)
            })
            .catch(error => {
                commit('set_error_nombre', error.response.data.errors.nombre)
                commit('set_error_tipo_entidad', error.response.data.errors.tipo_entidad)
                commit('set_error_cuit', error.response.data.errors.cuit)
                commit('set_error_cuil', error.response.data.errors.cuil)
                commit('set_error_email', error.response.data.errors.email)
                commit('set_error_telefono', error.response.data.errors.telefono)
                commit('set_error_direccion', error.response.data.errors.direccion)
            })
    },

    listarIniciadores ({ commit })  {
        axios.get(process.env.VUE_APP_API_URL+ '/api/index-iniciador')
            .then(response => {
                commit('set_listado', response.data)
            })
    },

    getIniciador ({ commit }, idIniciador)  {
    axios.post(process.env.VUE_APP_API_URL+ '/api/edit-iniciador', idIniciador)
            .then(response => {
                commit('set_iniciador', response.data)
                router.push('/editar-iniciador');
            })
    },

    updateIniciador ({ commit }, inic)  {
        axios.post(process.env.VUE_APP_API_URL+ '/api/update-iniciador', inic)
            .then(response => {
                commit('set_iniciador', response.data)
                commit('set_show_modal_edit_iniciador', true)
            })
            .catch(error => {
                 commit('set_error_email', error.response.data.errors.email)
                 commit('set_error_telefono', error.response.data.errors.telefono)
                 commit('set_error_direccion', error.response.data.errors.direccion)
            })
    },

     showModalEditIniciador ({commit}, modal) {
         commit('set_show_modal_edit_iniciador', modal)
     }
};

const mutations = {
    set_tipoSelected: (state, tipoEntidad) => state.tipoEntidad = tipoEntidad,
    set_iniciador: (state, iniciador) => state.iniciador = iniciador,
    set_listado: (state, listado) => state.listado = listado,
    set_exito_iniciador: (state, exito_iniciador) => state.exito_iniciador = exito_iniciador,
    set_show_modal_edit_iniciador: (state, show_modal_edit_iniciador) => state.show_modal_edit_iniciador = show_modal_edit_iniciador,

    set_error_nombre: (state, error_nombre) => state.error_nombre = error_nombre,
    set_error_tipo_entidad: (state, error_tipo_entidad) => state.error_tipo_entidad = error_tipo_entidad,
    set_error_cuit: (state, error_cuit) => state.error_cuit = error_cuit,
    set_error_cuil : (state, error_cuil) => state.error_cuil = error_cuil,
    set_error_telefono: (state, error_telefono) => state.error_telefono = error_telefono,
    set_error_email: (state, error_email) => state.error_email = error_email,
    set_error_direccion: (state, error_direccion) => state.error_direccion = error_direccion,
};

export default {
    namespace: true,
    state,
    getters,
    actions,
    mutations
}