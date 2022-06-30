<template>
  <div>
    <titulo-inicio texto="Iniciadores"/>

      <ButtonBig v-if="get_user.area === 'DPTO. MESA DE ENTRADAS Y SALIDAS' && get_user.cargo === 'Administrador Area'  " class="my-2 mr-6" texto="Nuevo" link="/nuevo-iniciador" icon="mdi-account-plus"/>

    <ButtonBig class="my-2 mr-6" texto="Ver todos" link="/iniciadores" icon="mdi-account-group"/>
  </div>
</template>

<script>
import ButtonBig from "../ButtonBig";
import TituloInicio from "../TituloInicio";
import {mapGetters} from "vuex";

export default {
  components: {ButtonBig, TituloInicio},

  computed: mapGetters(['get_user']),
}
</script>