<template>
  <div>
    <titulo texto="SUBSIDIO y/o E/CTAS.APORTES NO REINTEGRABLE GASTOS." icono="mdi-file-document"/>
    <tabla-motivo-subsidio class="mb-15 pb-15" :headers="headers" :data="get_subsidio_expedientes" :loading="get_finalizado"/>
    </div>
</template>
<script>
import Titulo from "../../components/Titulo"
import TablaMotivoSubsidio from "../../components/Tablas/TablaMotivoSubsidio";
import {mapActions,mapGetters} from "vuex";

export default {
  name: 'BandejaDeEntrada',
  components: {TablaMotivoSubsidio, Titulo},
  data() {
    return {
      headers: [
        {text: 'Prioridad', value: 'prioridad', align: 'center', width: "5%"},
        {text: 'Nro. de Expediente', value: 'nroExpediente', align: 'center', width: "10%"},
        {text: 'Extracto', value: 'extracto', width: "40%"},
        {text: 'Área Actual', value: 'descripcionArea', width: "12%"},
        {text: 'Tramite', value: 'tipoExpediente', align: 'center', width: "5%"},
        {text: 'Fecha Creación', value: 'fecha_creacion', align: 'center', width: "5%"},
        {text: 'Hora Creación', value: 'hora', align: 'center', width: "5%"},
        {text: 'Cuerpo', value: 'cantCuerpos', align: 'center', width: "5%"},
        {text: 'Fojas', value: 'cantFojas', align: 'center', width: "5%"},
      ],
      estado: 1,
      cargando:true,
    }
  },

  computed: mapGetters(['get_subsidio_expedientes', 'getIdUser', 'get_finalizado','get_expedientes']),

  mounted() {
    this.listadoMotivoSubsidio();
  },

  methods: {
    ...mapActions(['cerrar', 'listadoMotivoSubsidio']),


    }
  }
</script>