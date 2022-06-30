<template>
  <div>
    <titulo texto="Historial Enviados" icono="mdi-file-send"/>
    <tabla-mis-enviados :headers="headers" :data="get_expedientes" :loading="get_finalizado" class="mb-15 pb-15"/>
  </div>
</template>

<script>
import Titulo from "../../components/Titulo";
import TablaMisEnviados from "../../components/Tablas/TablaMisEnviados";
import {mapActions, mapGetters} from "vuex";

export default {
  components: {Titulo, TablaMisEnviados},
  data() {
    return {
      headers: [
        {text: 'N° de Expediente', value: 'nro_expediente'},
        {text: 'Extracto', value: 'extracto'},
        {text: 'Motivo', value: 'motivo'},
        {text: 'Fecha Envío', value: 'fecha'},
        {text: 'Área Destino', value: 'area_destino'},
        {text: 'Usuario', value: 'nombre_usuario'},
      ],
    }
  },

  computed: mapGetters(['get_expedientes','get_finalizado']),

  mounted() {
    this.historialEnviados();
  },

  methods: {
    ...mapActions(['historial_enviados']),

    historialEnviados(){
      let form = {
        all: 'true'
      }
      this.historial_enviados(form)
    }
  },
}
</script>