<template>
  <v-dialog v-model="show" width="1200px" content-class="round" persistent>
    <v-card class="px-7 pt-1">
      <titulo texto="¿Está seguro que desea tomar este expediente?" icono="mdi-alert-circle"/>

      <div class="textHereSmall Montserrat-Regular my-4 mr-2">
          Este expediente está siendo tramitado por otro empleado del área.
      </div>

      <v-row no-gutters justify="center" class="mt-6">
        <v-col cols="12" sm="6" md="6" lg="6" class="py-6 px-sm-2">
          <v-btn
            @click="close"
            class="pa-5 color Montserrat-SemiBold"
            height="55"
            elevation="0"
            color="#FACD89"
            block
          >
            <v-icon class="px-5"> mdi-close-thick </v-icon>
            Cerrar
          </v-btn>
        </v-col>
        <v-col cols="12" sm="6" md="6" lg="6" class="py-6 px-sm-2">
          <v-btn
            class="pa-5 color Montserrat-SemiBold"
            height="55"
            elevation="0"
            color="#FACD89"
            block
            @click="regresar(dato)"
          >
            <v-icon class="px-5"> mdi-check-bold </v-icon>
            Tomar
          </v-btn>
        </v-col>
      </v-row>
    </v-card>
  </v-dialog>
</template>

<script>
import Titulo from "../../components/Titulo";
import { mapActions } from "vuex";
export default {
  name: "ModalTomarExp",
  components: {Titulo},
  props: {
    show: { type: Boolean, default: false },
    dato: Object,
  },

  methods: {
    close() {
      this.$emit("close");
      this.$router.go(0);
    },

    regresar (dato) {
      this.tomarExpediente(dato);
    },

    ...mapActions([
      "tomarExpediente"
    ]),
  }

};
</script>
<style>
.round {
  border-radius: 30px;
}
.titleBig{
    font-size: 28px;
}
.textHereSmall{
    font-size: 22px;
}
</style>
