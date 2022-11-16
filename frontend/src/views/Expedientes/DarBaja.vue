<template>
  <div>
    <titulo texto="Dar de Baja" icono="mdi-text-box-multiple"/>
    <!--<div class="descripcion text-justify py-4">Si desea <strong>ver detalle e historial</strong> de un expediente, haga clic en el botón de la tabla.</div>-->
    <alert-sucess texto="El expediente ha sido dado de baja con éxito" :condicion="get_aceptado"/>
    <tabla-expedientes-baja class="mb-15 pb-15"  :data="get_expedientes" :loading="get_finalizado"/>
  </div>
</template>
<script>
import Titulo from "../../components/Titulo"
import TablaExpedientesBaja from "@/components/Tablas/TablaExpedientesBaja";
import AlertSucess from "../../components/AlertSucess"
import {mapActions,mapGetters} from "vuex";

export default {
  name: 'BandejaDeEntrada',
  components: {TablaExpedientesBaja, Titulo, AlertSucess},
  data() {
    return {
      estado: 4,
      cargando:true,
    }
  },

  computed: mapGetters(['get_expedientes','get_aceptado', 'get_finalizado']),

  mounted() {
    this.getBandeja();
  },

  methods: {
    ...mapActions(['cerrar', 'todosExpedientes','listadoExpedientes']),

    getBandeja(){
      let bandeja = {
        bandeja: 8,
      }
      this.listadoExpedientes(bandeja)
    },

  }
}
</script>