import axios from "axios";

const state = {
    //Arrays
    motivos: [],
    areas_filtros: [],
};

const getters = {
    get_motivos: state => state.motivos,
    get_areas_filtros: state => state.areas_filtros
}

const actions = {
    index_filtros ({commit}, expediente) {
        axios.get(process.env.VUE_APP_API_URL+ '/api/all-motivos', expediente)
            .then(response => {
                let todos = {id: 0, descripcion: 'TODOS'}
                let motivos_response = response.data[0]
                let todos_motivos_response = motivos_response.concat(todos)

                commit('set_motivos', todos_motivos_response)
                commit('set_areas_filtros', response.data[1])
            })
    },
}

const mutations = {
    set_motivos: (state,motivos) => state.motivos = motivos,
    set_areas_filtros: (state, areas_filtros) => state.areas_filtros = areas_filtros
}

export default {
    namespace: true,
    state,
    getters,
    actions,
    mutations
}

