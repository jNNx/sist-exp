<template>
  <v-dialog v-model="show" max-width="810px">
    <v-card>
      <h2 class="text-center texto pt-2 pt-md-4 px-4">
        ¿Está seguro que quiere recuperar el expediente N° 800-28-04-1000/2021 enviado al área de Auditoría?
      </h2>
      <h2 class="leyendaDialog text-center mt-4 px-4">El expediente aun no ha sido recibido por el área destino</h2>
      <v-card-actions class="mt-6 pb-4">
        <v-spacer></v-spacer>
        <v-btn color="#facd89">
          <v-icon left color="#393b44">
            mdi-email-receive
          </v-icon>
          <span class="boton">
                   Recuperar
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
</template>
<script>
export default {
  name: 'DialogEnviados',
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
.texto{
  font-family: "Montserrat-Bold";
  color: #393b44;
  font-size: 23px;
}

.boton{
  font-family: "Montserrat-Semibold";
  color: #393b44;
}

.leyendaDialog{
  font-family: "Montserrat";
  color: #393b44;
  font-size: 20px;
  font-weight: normal;
}
</style>