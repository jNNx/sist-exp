<template>
  <div>
    <titulo texto="Desglose" icono="mdi-file-percent"/>
    <div v-if="this.getExpedientesPadres.length == 0">
      <v-alert prominent outlined icon="mdi-alert" type="warning" border="left" class="contentSize mt-8">
      No posee expedientes para desglosar. Si desea englosar expedientes,<a href="/englose" class="mx-2 warning--text"><strong class="warning--text">haga clic aquí.</strong></a>
      </v-alert>
    </div>
    <div v-else>
      <div class="descripcion text-justify py-4">Si desea <strong>desglosar</strong> un expediente, seleccione el mismo de la lista.</div>
      <stepper-desglose :data="getExpedientesPadres"/>
    </div>
  </div>
</template>

<script>
import Titulo from "../../components/Titulo";
import StepperDesglose from "../../components/StepperDesglose";
import {mapActions, mapGetters} from "vuex";

export default {
  components: {Titulo, StepperDesglose},

  computed: mapGetters(['get_finalizado', 'getExpedientesPadres']),

  mounted() {
    this.desglosarVerPadres();
  },

  methods: {
    ...mapActions(['desglosarVerPadres','cerrar']),
  },

}
</script>