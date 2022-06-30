<template>
  <v-dialog v-model="show" width="1200px" content-class="round">
    <v-card class="px-7 pt-1">
        <titulo texto="Se guardaron con éxito los cambios" icono="mdi-check-all"/>
        <div class="sizeTextSmall Montserrat-SemiBold pt-4">Nombre: <span class="sizeTextSmall Montserrat-Regular"> {{iniciador.nombre}} </span></div>
        <div v-if="iniciador.cuil !== '-'" class="sizeTextSmall Montserrat-SemiBold pt-4">CUIL: <span class="sizeTextSmall Montserrat-Regular"> {{iniciador.cuil}} </span></div>
        <div v-if="iniciador.cuit !== '-'" class="sizeTextSmall Montserrat-SemiBold pt-4">CUIT: <span class="sizeTextSmall Montserrat-Regular"> {{iniciador.cuit}} </span></div>
        <div v-if="iniciador.email !== '-'" class="sizeTextSmall Montserrat-SemiBold pt-4">Correo Electrónico: <span class="sizeTextSmall Montserrat-Regular"> {{iniciador.email}} </span></div>
        <div v-if="iniciador.telefono !== '-'" class="sizeTextSmall Montserrat-SemiBold pt-4">Teléfono: <span class="sizeTextSmall Montserrat-Regular"> {{iniciador.telefono}} </span></div>
        <div v-if="iniciador.direccion !== '-'" class="sizeTextSmall Montserrat-SemiBold pt-4">Dirección: <span class="sizeTextSmall Montserrat-Regular"> {{iniciador.direccion}} </span></div>
        <v-row no-gutters justify="center" class="mt-8">
            <v-col cols="12" sm="6" md="6" lg="6" class="py-6 px-sm-2">
                <v-btn @click="close" href="/iniciadores" class="pa-5 color Montserrat-SemiBold" height="55" elevation="0" color="#FACD89" block>
                    <v-icon class="px-5"> mdi-check-bold </v-icon>
                    Aceptar
                </v-btn>
            </v-col>
        </v-row>
    </v-card>
  </v-dialog>
</template>
<script>

import Titulo from "../Titulo"
import {mapGetters } from "vuex";

export default {
  name: 'ModalExitoEditarIniciador',
  components: {Titulo},

  computed: mapGetters(['iniciador']),

  props: {
    show: Boolean,
  },

  methods: {
    close() {
      this.$emit("close");
      this.$router.go(0);
    },
  }
}
</script>
<style>
.round {
  border-radius: 30px;
}
</style>