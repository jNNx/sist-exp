<template>
  <v-dialog v-model="show" max-width="810px">
    <v-card>
      <h2 class="texto pt-3 pl-6 text-left">
        Expediente N° 800-28-04-1000/2021
      </h2>
      <v-card-text>
        <div class="texto">
          <v-row class="mt-3">
            <v-col cols="12" md="6">
              Iniciador: <span class="datos">Responsable</span>
            </v-col>
          </v-row>
          <v-row>
            <v-col cols="12" >
              Extracto: <span class="justify-text datos"> Rendicion de cuentas N°01/20 fdo. pte. gtos. bienes de consumo no personales. bs. uso y transf.
                  dcto N°2548/20 $1.000.000,00 (ministerio reparticion)</span>
            </v-col>
          </v-row>
          <v-row>
            <v-col cols="12" md="6">
              Fecha: <span class="datos">28-04-2021</span>
            </v-col>
          </v-row>
          <v-row>
            <v-col cols="12" sm="6">
              Cantidad de Folios: <span class="datos">20</span>
            </v-col>
            <v-col cols="12" sm="6">
              Nro de Cuerpos: <span class="datos">20</span>
            </v-col>
          </v-row>
        </div>
      </v-card-text>
      <v-card-actions class="pb-4 mt-4">
        <v-spacer></v-spacer>
        <v-btn color="#facd89"  @click="close">
          <v-icon left color="#393b44">
            mdi-close-thick
          </v-icon>
          <span class="boton">
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
  name: 'DialogExpediente',
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
  font-size: 22px;
}

.boton{
  font-family: "Montserrat-Semibold";
  color: #393b44;
}
.datos{
  font-family: "Montserrat";
  color: #393b44;
}
</style>