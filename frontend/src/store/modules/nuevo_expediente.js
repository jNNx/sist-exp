import axios from "axios";

const state = {
    nro_expediente: '000 - 0000000 - 0000',

    iniciadores: [],
    fecha: '',
    motivoSinExtracto: [],
    motivoConExtracto: [],
    areas_nuevo: [],
    prioridad: [],
    iniciadorSelected: 0,
    motivoSelected: 0,

    creado: false,
    expediente: [],
    extracto: '', //para guardar el extracto v-model

    descripcion_extractoerror: [],
    iniciador_iderror: [],
    nro_fojaserror: [],
    prioridaderror: [],
    pase_a_error: [],

    btn_creado: false,
    error_preview: false
};

const getters = {
    nro_expediente: state => state.nro_expediente,
    expediente_new: state => state.expediente,
    allIniciadores: state => state.iniciadores,
    fecha: state => state.fecha,
    motivoSinExtracto: state => state.motivoSinExtracto,
    motivoConExtracto: state => state.motivoConExtracto,
    prioridad: state => state.prioridad,
    get_iniciadorSelected: state => state.iniciadorSelected,
    get_areas_all: state => state.areas_nuevo,
    creado: state => state.creado,
    descargado: state => state.descargado,

    get_extracto: state => state.extracto,
    descripcion_extracto_error: state => state.descripcion_extractoerror,
    iniciador_id_error: state => state.iniciador_iderror,
    nro_fojas_error:  state => state.nro_fojaserror,
    prioridad_error:  state => state.prioridaderror,
    pase_a_error:  state => state.pase_a_error,

    get_btn_creado: state => state.btn_creado,
    get_motivo_selected: state => state.motivoSelected,
    get_error_modal_preview: state => state.error_preview
};

const actions = {

    capturarMotivo ({ commit }, motivo) {
        commit ('set_motivoSelected', motivo)
    },

    capturarIniciador ({ commit }, iniciador) {
        commit ('set_iniciadorSelected', iniciador)
    },

    getCreate ({ commit })  {
        axios.get(process.env.VUE_APP_API_URL+ '/api/createExp')
            .then(response => {
                let fec= response.data[0];
                commit('set_fecha', fec)

                let inici = response.data[1];
                commit('set_iniciadores', inici)

                let motivosin = response.data[2];
                commit('set_motivoSinExt', motivosin)

                let motivocon = response.data[3];
                commit('set_motivoConExt', motivocon)

                let priori = response.data[4];
                commit('set_prioridad', priori)

                let are = response.data[5];
                commit('set_area', are)
            })
    },

    storeExpediente ({ commit }, expediente) {
        commit('set_btn_creado', true);
        axios.post(process.env.VUE_APP_API_URL+ '/api/storeExp', expediente).
        then(response => {
                commit('saveNewExp', response.data)
                commit('set_creado', true)
                commit('set_btn_creado', false)
                commit('cerrar_modal_preview', false)
        })
        .catch(error => {
                commit('cerrar_modal_preview', false)
                commit('set_descripcion_extracto_error', error.response.data.errors.descripcion_extracto)
                commit('set_iniciador_id_error', error.response.data.errors.iniciador_id)
                commit('set_nro_fojas_error', error.response.data.errors.nro_fojas)
                commit('set_prioridad_error', error.response.data.errors.prioridad_id)
                commit('set_pase_a_error', error.response.data.errors.area_id)
                commit('set_btn_creado', false)
            })
    },

    getArchivos ({ commit }, archivo)  {
        axios.post(process.env.VUE_APP_API_URL+ '/api/zip', archivo, {
            responseType: 'arraybuffer',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/zip'
            }
        })
            .then(response => {
                var fileURL = window.URL.createObjectURL(new Blob([response.data]));
                var fileLink = document.createElement('a');

                var nro_expediente = archivo.nro_expediente
                fileLink.href = fileURL;
                fileLink.setAttribute('download', nro_expediente + '.zip');
                document.body.appendChild(fileLink);

                fileLink.click();
                commit('set_decargado', true)
            })
    },

    abrir_modal_preview ({commit}, modal_valor) {
        commit('cerrar_modal_preview', modal_valor)
    },
    extracto ({ commit }, extracto) {
        commit('saveExtracto',extracto)
    },

};

const mutations = {

    saveExtracto: (state, extracto) => state.extracto = extracto,
    saveNewNroExpediente:(state, nro_expediente) => state.nro_expediente = nro_expediente,
    set_fecha: (state, fecha) => state.fecha = fecha,
    set_iniciadores: (state, iniciadores) => state.iniciadores = iniciadores,
    set_motivoSinExt: (state, motivoSinExtracto) => state.motivoSinExtracto = motivoSinExtracto,
    set_motivoConExt: (state, motivoConExtracto) => state.motivoConExtracto = motivoConExtracto,
    set_prioridad: (state, prioridad) => state.prioridad = prioridad,
    set_iniciadorSelected: (state, iniciadorSelected) => state.iniciadorSelected = iniciadorSelected,
    set_area: (state, areas_nuevo) => state.areas_nuevo = areas_nuevo,
    saveNewExp: (state, expediente) => state.expediente = expediente,
    set_creado: (state, creado) => state.creado = creado,
    set_decargado: (state, descargado) => state.descargado = descargado,

    set_motivoSelected: (state, motivoSelected) => state.motivoSelected = motivoSelected,

    set_descripcion_extracto_error: (state,descripcion_extractoerror)  =>  state.descripcion_extractoerror = descripcion_extractoerror,
    set_iniciador_id_error: (state,iniciador_iderror ) => state.iniciador_iderror = iniciador_iderror,
    set_nro_fojas_error:  (state,nro_fojaserror ) => state.nro_fojaserror = nro_fojaserror,
    set_prioridad_error:  (state,prioridaderror ) => state.prioridaderror = prioridaderror,
    set_pase_a_error:  (state,pase_a_error ) => state.pase_a_error = pase_a_error,
    
    set_btn_creado:(state,btn_creado) =>state.btn_creado = btn_creado,

    cerrar_modal_preview: (state, error_preview) => state.error_preview = error_preview
};

export default {
    namespace: true,
    state,
    getters,
    actions,
    mutations
}




