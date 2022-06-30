import axios from "axios";

const state = {
    user: {},
    logueado: false,
    loading: false,
    status: JSON.parse(localStorage.getItem('status') || "false" ),
    token: JSON.parse(localStorage.getItem('token') || "{}" ),
    nro: JSON.parse(localStorage.getItem('nro') || "{}" ),
    cargo: JSON.parse(localStorage.getItem('cargo') || "{}" ),
    btn_login: false,

    //errores login
    errores: false,
    error_logeo: '',
    error_cuil: '',
    error_contra: '',
    overlay: false,
    area:'',
    restart: false,

    newPass: false,
    verificarPass: false,
    error_passwordOld: '',
    error_passwordFail: '',
};

const getters = {
    get_user: state => state.user,
    get_authenticated: state => state.status,
    get_loading: state => state.loading,
    get_btn_login: state => state.btn_login,
    get_token: state => state.token,
    get_cargo: state => state.cargo,

    get_restart: state => state.restart,
    get_errores: state => state.errores,
    //usario o contraseña incorrecta
    get_error_logeo: state => state.error_logeo,
    get_error_Cuil: state => state.error_cuil,

    //para contraseña vacia o con letras
    get_error_contra: state => state.error_contra,
    get_nro: state => state.nro,
    get_logueo: state => state.logueado,
    get_area: state => state.user.area,

    getNewPass: state => state.newPass,
    getVerificarPass: state => state.verificarPass,
    getErrorPassOld: state => state.error_passwordOld,
    getErrorPassFail: state => state.error_passwordFail,
};

const actions = {

    getUsuario({ commit }){
        commit('set_btn_login', true);
        axios.post(process.env.VUE_APP_API_URL+ '/api/userData')
            .then(response => {
                commit('set_user', response.data)
                commit('set_btn_login', false)
            })
            .catch(error => {
                commit('set_restart', true)
                commit('clearUserData')
                commit('set_btn_login', false)
                //sessionStorage.clear()
                console.log(error.response.data)
            })
    },

   login ({ commit }, user) {
       commit('set_btn_login', true);
        axios.post(process.env.VUE_APP_API_URL+ '/api/login', user)
            .then(response => {
                //commit('set_authenticated', response.data.status)
                    localStorage.setItem('status',JSON.stringify(response.data.status))
                    localStorage.setItem('token',JSON.stringify(response.data.access_token))
                    localStorage.setItem('nro',JSON.stringify(response.data.id))
                    localStorage.setItem('cargo',JSON.stringify(response.data.cargo))
                    commit('set_user', response.data)
                    commit('set_logueo', true)

            })
            .catch(error => {
                commit('set_btn_login', false)
                commit('set_error_logeo',error.response.data.mensaje)
                commit('set_error_cuil', error.response.data.errors.cuil)
                commit('set_error_contra', error.response.data.errors.password)
            })
    },

    logout ({ commit }) {
        commit('set_btn_login', true);
        axios.post(process.env.VUE_APP_API_URL+ '/api/salir')
            .then( commit('clearUserData'))
    },

    verificarPass({commit}, newPass){
        axios.post(process.env.VUE_APP_API_URL+ '/api/validarPassword', newPass)
            .then(response => {
                if (response.status === 201){
                    commit('set_error_passFail', response.data)
                }else{
                    commit('setVerificarPass', response.data)
                }
            })
            .catch(error => {
                commit('set_error_passOld', error.response.data.errors.password[0])
            })
    },

    nuevaContrasena({commit}, newPass){
        axios.post(process.env.VUE_APP_API_URL+ '/api/actualizaPassword', newPass)
            .then(() => {
                commit('setNewPass', true)
                commit('set_error_passFail', '')
            })
            .catch(error => {
                commit('set_error_passFail', error.response.data.errors.password[0])
            })
    },

    mis_enviados({commit}, expediente){
        axios.post(process.env.VUE_APP_API_URL+ '/api/mis-enviados', expediente)
            .then(response => {
                commit('set_expedientesEnviados', response.data),
                commit('set_finalizadoEnviados', false)
            })
    }
};

const mutations = {
    clearUserData: () => {
        localStorage.removeItem('token')
        localStorage.removeItem('status')
        localStorage.removeItem('nro')
        localStorage.removeItem('cargo')
    },
    set_aceptado: (state,aceptado) => state.aceptado = aceptado,
    set_logueo: (state, logueado) => state.logueado = logueado,
    set_user: (state, user) => state.user = user,
    set_authenticated: (state, status) => state.status = status,
    set_btn_login:(state,btn_login) => state.btn_login = btn_login,
    set_restart: (state, restart) => state.restart = restart,
    set_errores:(state, errores) => state.errores = errores,
    set_error_logeo:(state, error_logeo) => state.error_logeo = error_logeo,
    set_error_cuil:(state, error_cuil) => state.error_cuil = error_cuil,
    set_error_contra:(state, error_contra) => state.error_contra = error_contra,
    setNewPass: (state, newPass) => state.newPass = newPass,
    set_error_passOld: (state, error_passwordOld) => state.error_passwordOld = error_passwordOld,
    set_error_passFail: (state, error_passwordFail) => state.error_passwordFail = error_passwordFail,
    setVerificarPass: (state, verificarPass) => state.verificarPass = verificarPass,
};

export default {
    namespace: true,
    state,
    getters,
    actions,
    mutations,
}