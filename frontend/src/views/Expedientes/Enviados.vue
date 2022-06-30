<template>
  <div>
    <titulo texto="Recuperar" icono="mdi-arrow-u-left-top-bold" />
    <div class="descripcion text-justify py-4">
      Si desea <strong>recuperar</strong> un expediente, haga clic en el botón
      de la tabla.
    </div>
    <alert
        texto="El expediente fue recuperado con éxito."
        type="success"
        :condicion="this.get_aceptado"
    />
    <tabla-enviados
      :headers="headers"
      :data="this.get_expedientes"
      :loading="this.get_finalizado"
      class="mb-15 pb-15"
    />
  </div>
</template>

<script>
import Titulo from "../../components/Titulo"
import Alert from "../../components/Alert"
import TablaEnviados from "../../components/Tablas/TablaEnviados";
import {mapActions, mapGetters} from "vuex";

export default {
  name: 'Enviados',
  components: {Titulo, Alert, TablaEnviados},
  data() {
    return {
      headers: [
        { text: 'Prioridad', value: 'prioridad' },
        { text: 'Nro. de Expediente', value: 'nro_expediente' },
        { text: 'Extracto', value: 'extracto' },
        { text: 'Fecha Creación', value: 'fecha_creacion' },
        { text: 'Área Destino', value: 'area_destino' },
        { text: 'Trámite', value: 'tramite' },
        { text: 'Cuerpo', value: 'cant_cuerpos' },
        { text: 'Fojas', value: 'fojas' },
        { text: 'Recuperar', value: 'action', align: 'center', sortable: false },
        {class: "display-4"},
      ],
    }
  },

  computed: mapGetters(['get_aceptado','get_expedientes','get_finalizado']),

  mounted() {
    this.getExpe();
  },

  methods: {
    ...mapActions(['listadoExpedientes']),

    getExpe(){
      let exp = {
        estado: 1,
        estado_expediente_id: 1,
        bandeja: 4,
      }
      this.listadoExpedientes(exp)
    },
  },

}
</script>
<style>
.descripcion {
  font-family: Montserrat-Regular;
  font-size: 20px;
}
</style>
