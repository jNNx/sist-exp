/**estado global **/
import Vue from 'vue'
import Vuex from 'vuex'
import expedientes from "./modules/expedientes";
import motivo_expedientes from "./modules/motivo_expedientes";
import prioridad_expedientes from "./modules/prioridad_expedientes";
import usuarios from "./modules/usuarios";
import areas from "./modules/areas";
import nuevo_expediente from "./modules/nuevo_expediente";
import nuevo_pase from "./modules/nuevo_pase"
import iniciador from "./modules/iniciadores"
import cedula from "./modules/cedula"
import englose from "./modules/englose";
import desglose from "./modules/desglose";
import notificaciones from "./modules/notificaciones";
import filtros from "./modules/filtros";

Vue.use(Vuex)

export default new Vuex.Store({
    useCredentails: true,
    namespace: true,
    modules: {
        expedientes,
        notificaciones,
        desglose,
        motivo_expedientes,
        prioridad_expedientes,
        usuarios,
        areas,
        nuevo_expediente,
        nuevo_pase,
        iniciador,
        englose,
        cedula,
        filtros
    },
})