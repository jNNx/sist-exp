<template>
  <div>
    <titulo texto="Expedientes de mi Área" icono="mdi-file-marker" />
    <alert
        texto="El expediente fue tomado con éxito."
        type="success"
        :condicion="this.get_aceptado"
    />

    <tabla-exp-area
      :data="get_expedientes"
      :loading="this.get_finalizado"
      class="mb-15 pb-15"
    />
  </div>
</template>

<script>
import Titulo from "../../components/Titulo"
import Alert from "../../components/Alert"
import TablaExpArea from "../../components/Tablas/TablaExpArea";
import {mapActions, mapGetters} from "vuex";

export default {
  components: {Titulo, Alert, TablaExpArea},

  computed: mapGetters(['get_expedientes', 'get_aceptado', 'get_finalizado']),

  mounted() {
    this.getBandeja();
  },
  
  methods: {
    ...mapActions(['listadoExpedientes']),

    getBandeja(){
      let bandeja = {
        estado: 1,
        bandeja: 6,
      }
      this.listadoExpedientes(bandeja)
    },
  }

}
</script>
<style>
.descripcion {
  font-family: Montserrat-Regular;
  font-size: 20px;
}
</style>
