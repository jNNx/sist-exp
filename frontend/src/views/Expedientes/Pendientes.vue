<template>
  <div>
    <titulo texto="Expedientes Pendientes" icono="mdi-bell"/>
   <!-- <div class="descripcion text-justify py-4">Si desea <strong>aceptar</strong> un expediente, haga clic en el botón de la tabla.</div>-->
    <alert-sucess texto="El expediente ha sido recibido con éxito" :condicion="this.get_aceptado"/>
    <tabla-pendientes class="mb-15 pb-15" :items="get_expedientes" :loading="get_finalizado"/>
    </div>
</template>
<script>

import Titulo from "../../components/Titulo"
import TablaPendientes from "../../components/Tablas/TablaPendientes";
import AlertSucess from "../../components/AlertSucess"
import {mapActions,mapGetters} from "vuex";

export default {
  name: 'BandejaDeEntrada',
  components: {TablaPendientes, Titulo, AlertSucess},

  computed: mapGetters(['get_expedientes','get_aceptado', 'get_finalizado']),

  mounted() {
    this.getBandeja();
  },

  methods: {
    ...mapActions(['listadoExpedientes']),

    getBandeja(){
      let bandeja = {
        estado: 1,
        bandeja: 1,
      }
      this.listadoExpedientes(bandeja)
    },
    }
  }
</script>