<template>
  <div class="pb-16 mb-16">
    <v-row no-gutters justify="start" class="pt-5">
      <titulo-area-sub :area="get_user.area" class="mb-4"/>
    </v-row>

    <v-divider color="#393B44" class="my-4"></v-divider>

    <div v-if="get_user.area === 'DPTO. MESA DE ENTRADAS Y SALIDAS'">
      <div class="d-flex justify-space-around">
        <bandejas/><iniciadores/>
      </div>

      <v-divider color="#393B44" class="my-8"></v-divider>
      <div class="d-flex justify-center"><expedientes-section /></div>
    </div>


    <div class="d-flex justify-space-around" v-if="get_user.area === 'DIRECCIÓN DE INFORMATICA'">
          <bandejas/>
          <iniciadores/>

      <v-divider color="#393B44" class="my-4"></v-divider>
          <expedientes-section />
    </div>


    <div v-if="get_user.area === 'DPTO. NOTIFICACIONES'">
      <div class="d-flex justify-space-around">
        <bandejas/> <cedula />
      </div>

      <v-divider color="#393B44" class="my-4"></v-divider>
      <div class="d-flex justify-center"><expedientes-section /></div>
    </div>

    <div v-if="get_user.area === 'DIRECCIÓN DE REGISTRACIONES'">
      <div class="d-flex justify-center">
        <bandejas/> <cedula />
      </div>

      <v-divider color="#393B44" class="my-4"></v-divider>
      <div class="d-flex justify-center"><expedientes-section /></div>
    </div>

    <div v-if="!(get_user.area === 'DPTO. MESA DE ENTRADAS Y SALIDAS' || get_user.area === 'DIRECCIÓN DE INFORMATICA' || get_user.area === 'DPTO. NOTIFICACIONES' || get_user.area === 'DIRECCIÓN DE REGISTRACIONES' )">
        <div class="d-flex justify-center">
          <bandejas/>
        </div>

        <v-divider color="#393B44" class="my-4"></v-divider>
        <div class="d-flex justify-center"><expedientes-section /></div>
    </div>

  </div>
</template>

<script>
//import TituloInicio from "../components/TituloInicio"
import TituloAreaSub from "../components/TituloAreaSub"
//import ModalConsultarNroExp from "../components/dialogs/ModalConsultarNroExp"
//import ButtonBig from "../components/ButtonBig"
import Bandejas from "../components/HomeSections/Bandejas";
import Cedula from "../components/HomeSections/Cedula";
import Iniciadores from "../components/HomeSections/Iniciadores";
import ExpedientesSection from "../components/HomeSections/ExpedientesSection";

import {mapGetters} from "vuex";

export default {
  name: 'Home',
  components: { TituloAreaSub, Bandejas, Cedula, Iniciadores, ExpedientesSection},

  computed: mapGetters(['get_user','get_authenticated','get_btn_login','get_area','get_nro']),

}
</script>

<style>
@media only screen and (max-width: 600px) {
  .phone {
    text-align: center;
    padding: 20px 0;
  }
}
</style>