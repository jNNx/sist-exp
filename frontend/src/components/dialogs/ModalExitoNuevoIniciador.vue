<template>
  <v-dialog v-model="show" width="1200px" content-class="round">
    <v-card class="px-7 pt-1">
        <titulo texto="Se ha creado con éxito un nuevo iniciador" icono="mdi-account-check"/>
        <v-row no-gutters justify="center" class="mt-8">
            <v-col cols="12" sm="6" md="6" lg="6" class="py-4 px-sm-2">
                <v-btn @click="close" href="/" class="pa-5 color Montserrat-SemiBold" height="55" elevation="0" color="#FACD89" block>
                    <v-icon class="pr-5"> mdi-check-bold </v-icon>
                    Aceptar
                </v-btn>
            </v-col>
        </v-row>
    </v-card>
  </v-dialog>
</template>
<script>
import Titulo from "../Titulo"
export default {
  name: 'ModalExitoNuevoIniciador',
  components: {Titulo},

  props: {
    show: Boolean,
  },
  methods: {
    close() {
      this.$emit("close")
    },
  }
}
</script>
<style>
.round {
  border-radius: 30px;
}
</style>