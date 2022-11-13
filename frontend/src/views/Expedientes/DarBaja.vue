<template>
  <div>
    <titulo texto="Dar de Baja" icono="mdi-text-box-multiple"/>
    <!--<div class="descripcion text-justify py-4">Si desea <strong>ver detalle e historial</strong> de un expediente, haga clic en el botón de la tabla.</div>-->
   <tabla-expedientes-baja class="mb-15 pb-15"  :data="get_todos_expedientes" :loading="get_finalizado"/>
  </div>
</template>
<script>
import Titulo from "../../components/Titulo"
import TablaExpedientesBaja from "@/components/Tablas/TablaExpedientesBaja";
import {mapActions,mapGetters} from "vuex";

export default {
  name: 'BandejaDeEntrada',
  components: {TablaExpedientesBaja, Titulo},
  data() {
    return {
      estado: 1,
      cargando:true,
    }
  },

  computed: mapGetters(['get_todos_expedientes', 'get_finalizado']),

  mounted() {
    this.todosExpedientes();
  },

  methods: {
    ...mapActions(['cerrar', 'todosExpedientes']),
  }
}
</script>