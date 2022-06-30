<template>
  <div class="mb-16">
    <titulo texto="Iniciadores" icono="mdi-account-group" />
    <div class="descripcion text-justify py-4">Si desea <strong>editar</strong> los datos de un iniciador, haga clic en el botón de la tabla.</div>
    <tabla-iniciadores :data="get_listado" class="mb-15 pb-15"/>
  </div>
</template>

<script>
import Titulo from "../../components/Titulo"
import TablaIniciadores from "../../components/Tablas/TablaIniciadores";
import {mapActions, mapGetters} from "vuex";

export default {
  name: 'Iniciadores',
  components: {TablaIniciadores, Titulo},

  computed:  mapGetters(['get_listado']),

  mounted() {
    this.listarIniciadores();
  },

  methods: {
    ...mapActions(['listarIniciadores']),
  },
}
</script>
