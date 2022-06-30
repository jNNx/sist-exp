<template>
  <div class="pb-16 mb-16">
    <v-row no-gutters justify="start" class="pt-5">
      <titulo-area-sub :area="get_user.area" class="mb-2"/>
    </v-row>

    <v-divider color="#393B44" class="my-4"></v-divider>

    <div v-if="get_user.area === 'DPTO. MESA DE ENTRADAS Y SALIDAS'">
        <v-row no-gutters class="mx-xl-16">
          <v-col cols="12" lg="6" xs="12" class="my-sm-6">
            <bandejas/>
          </v-col>

          <v-col cols="12" lg="4" xs="12" class="my-sm-6">
            <iniciadores/>
          </v-col>

        </v-row>

        <v-divider color="#393B44" class="my-4"></v-divider>

        <v-row no-gutters class="mx-xl-16">
          <v-col cols="12" lg="12" xs="12" class="my-sm-6">
            <expedientes-section />
          </v-col>
        </v-row>
    </div>

    <div v-if="get_user.area === 'DIRECCIÓN DE INFORMATICA'">
      <v-row no-gutters class="mx-xl-16">
        <v-col cols="12" lg="6" xs="12" class="my-sm-6">
          <bandejas/>
        </v-col>

        <v-col cols="12" lg="4" xs="12" class="my-sm-6">
          <iniciadores/>
        </v-col>
      </v-row>

      <v-divider color="#393B44" class="my-4"></v-divider>

      <v-row no-gutters class="mx-xl-16">
        <v-col cols="12" lg="12" xs="12" class="my-sm-6">
          <expedientes-section />
        </v-col>
      </v-row>
    </div>

    <div v-if="get_user.area === 'DPTO. NOTIFICACIONES'">
      <v-row no-gutters class="mx-xl-16">
        <v-col cols="12" lg="6" xs="12" class="my-sm-6">
          <bandejas/>
        </v-col>

        <v-col cols="12" lg="6" xs="12" class="my-sm-6">
          <expedientes-section />
        </v-col>
      </v-row>
      
      <v-divider color="#393B44" class="my-4"></v-divider>

      <v-row no-gutters class="mx-xl-16">
        <v-col cols="12" lg="12" xs="12" class="pt-9">
          <cedula />
        </v-col>
      </v-row>
    </div>

    <div v-if="get_user.area === 'DIRECCIÓN DE REGISTRACIONES'">
      <v-row no-gutters class="mx-xl-16">
        <v-col cols="12" lg="6" xs="12" class="my-sm-6">
          <bandejas/>
        </v-col>

        <v-col cols="12" lg="6" xs="12" class="my-sm-6">
          <expedientes-section />
        </v-col>
      </v-row>

      <v-divider color="#393B44" class="my-4"></v-divider>

      <v-row no-gutters class="mx-xl-16">
        <v-col cols="12" lg="12" xs="12" class="my-sm-6">
          <cedula/>
        </v-col>
      </v-row>
    </div>

    <div v-if="!(get_user.area === 'DPTO. MESA DE ENTRADAS Y SALIDAS' || get_user.area === 'DIRECCIÓN DE INFORMATICA' || get_user.area === 'DPTO. NOTIFICACIONES' || get_user.area === 'DIRECCIÓN DE REGISTRACIONES' )">
      <v-row no-gutters class="mx-xl-16">
        <v-col cols="12" lg="6" xs="12" class="my-sm-6">
          <bandejas/>
        </v-col>

        <v-col cols="12" lg="6" xs="12" class="my-sm-6">
          <expedientes-section />
        </v-col>
      </v-row>
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