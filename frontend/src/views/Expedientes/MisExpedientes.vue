<template>
  <div>
    <titulo texto="Pase" icono="mdi-file-document" />
    <!--<div class="descripcion text-justify py-4">Si desea <strong>realizar un pase</strong>, haga clic en el botón de la tabla.</div>-->
    <alert-sucess texto="El expediente ha sido asignado con éxito" :condicion="get_aceptado"/>
    <tabla-mis-expedientes class="mb-15 pb-15" :data="get_expedientes" :loading="get_finalizado"/>
  </div>
</template>

<script>
import Titulo from "../../components/Titulo"
import {mapActions, mapGetters} from "vuex";
import TablaMisExpedientes from "../../components/Tablas/TablaMisExpedientes";
import AlertSucess from "../../components/AlertSucess"

export default {
  name: 'MisExpedientes',
  components: {TablaMisExpedientes, Titulo, AlertSucess},

  computed: mapGetters(['get_expedientes', 'get_finalizado','get_aceptado']),

    mounted() {
      this.getExpe();
    },

    methods: {
    ...mapActions(['listadoExpedientes']),

      getExpe(){
        let exp = {
          estado: 3,
          bandeja: 3,
        }
        this.listadoExpedientes(exp)
      },

  },
}
</script>
