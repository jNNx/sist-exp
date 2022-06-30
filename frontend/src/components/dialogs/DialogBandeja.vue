<template>
  <div>
    <v-dialog v-model="show" max-width="810px">
      <v-card>
        <h2 class="text-center texto pt-2 pt-md-4 px-4">
          ¿Está seguro que quiere recibir el expediente nro {{ nro_expediente }}?
        </h2>
        <v-card-actions class="mt-6 pb-4">
          <v-spacer></v-spacer>
          <v-btn color="#facd89">
            <v-icon left color="#393b44">
              mdi-email-send
            </v-icon>
            <span class="boton">
                   Aceptar
            </span>
          </v-btn>
          <v-btn  @click="close" elevation="0" color="white">
            <v-icon left color="grey darken-1">
              mdi-close-thick
            </v-icon>
            <span class="grey--text text--darken-1 boton">
                   Cancelar
            </span>
          </v-btn>
          <v-spacer></v-spacer>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>
<script>
export default {
  name: 'DialogBandeja',
  props: {
    show: Boolean,
    nro_expediente: String,
  },
  methods: {
    close() {
      this.$emit("close")
    },
  }
}
</script>
<style>
.texto{
  font-family: "Montserrat-Bold";
  color: #393b44;
  font-size: 23px;
}

.boton{
  font-family: "Montserrat-Semibold";
  color: #393b44;
}
</style>