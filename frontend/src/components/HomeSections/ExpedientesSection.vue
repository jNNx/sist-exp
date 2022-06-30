<template>
  <div>
    <titulo-inicio texto="Expedientes"/>
      <v-hover v-slot="{ hover }">
        <v-btn
            rounded
            width="170"
            height="170"
            @click="abrirModalConsultar()"
            :class="hover ? 'orange accent-1' : 'grey lighten-3'"
            class="pa-8 mr-6 Montserrat-Bold grey--text text--darken-3"
        >
          <div class="d-flex flex-column justify-center">
            <v-icon size="90" class="py-2" :color="hover ? 'grey darken-1' : '#FDBC3F'">mdi-magnify</v-icon>

            <div class="sizeBig pt-4">
              Consultar
            </div>
          </div>
        </v-btn>
      </v-hover>
      <modal-consultar-nro-exp :show="showModalConsultarNroExp" @close="closeModalConsultarNroExp"/>
      <ButtonBig v-if="(get_user.area === 'DPTO. MESA DE ENTRADAS Y SALIDAS')" class="my-2 mr-6" texto="Nuevo" link="/nuevo-expediente" icon="mdi-text-box-plus"/>
      <ButtonBigTooltip class="my-2 mr-6" texto="Pase" link="/mis-expedientes" icon="mdi-file-move" tooltip="Mis expedientes"/>
      <ButtonBig class="my-2 mr-6" texto="Recuperar" link="/recuperar" icon="mdi-file-undo"/>
      <ButtonBigTooltip v-if="(get_user.area === 'DPTO. MESA DE ENTRADAS Y SALIDAS')" class="my-2 mr-6" texto="Englose" link="/englose" icon="mdi-file-plus" tooltip="Acumulación"/>
      <ButtonBig v-if="(get_user.area === 'DPTO. MESA DE ENTRADAS Y SALIDAS')" class="my-2 mr-6" texto="Desglose" link="/desglose" icon="mdi-file-percent"/>
  </div>
</template>

<script>
import ButtonBig from "../ButtonBig";
import ButtonBigTooltip from "../ButtonBigTooltip";
import TituloInicio from "../TituloInicio";
import ModalConsultarNroExp from "../dialogs/ModalConsultarNroExp";
import {mapGetters} from "vuex";

export default {
  components: {ButtonBig, ButtonBigTooltip, TituloInicio, ModalConsultarNroExp},

  data() {
    return {
      showModalConsultarNroExp: false,
    }
  },

  computed: mapGetters(['get_user']),

  methods: {
    abrirModalConsultar() {
      this.showModalConsultarNroExp = !this.showModalConsultarNroExp
    },

    closeModalConsultarNroExp() {
      this.showModalConsultarNroExp = false;
    },
  },


}
</script>