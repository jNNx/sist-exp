<template>
  <v-dialog v-model="show" width="1200px" content-class="round">
    <v-card class="px-7 pt-1">
        <v-row class="mt-5 mb-2">
          <v-col cols="10">
            <h2 class="Montserrat-Bold text-justify red--text">
              Tipo de archivo seleccionado no válido
              
            </h2>
          </v-col>
          <v-col cols="2" align="right">
            <v-icon left large color="#FF0000"> mdi-alert-circle </v-icon>
          </v-col>
        </v-row>

        <v-divider color="#393B44" class="mt-2"></v-divider>   

        <div class="sizeTextSmall Montserrat-SemiBold pt-4">Por favor, seleccione un tipo de archivo válido (.docx .txt .pdf .jpg .jpeg). No mayor a 25MB.</div>
        <v-row no-gutters justify="center" class="mt-8">
            <v-col cols="12" sm="6" md="6" lg="6" class="py-6 px-sm-2">
                <v-btn @click="close" class="pa-5 color Montserrat-SemiBold" height="55" elevation="0" color="#FACD89" block>
                    <v-icon class="px-5"> mdi-check-bold </v-icon>
                    Aceptar
                </v-btn>
            </v-col>
        </v-row>
    </v-card>
  </v-dialog>
</template>
<script>


export default {
  name: 'ModalErrorTipoArchivo',  

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