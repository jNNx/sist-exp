<template>
  <v-dialog v-model="show" width="1200px" content-class="round" persistent>
    <v-card class="px-7 pt-1">
      <titulo texto="Englose realizado con éxito" icono="mdi-check-all"/>
      <!-- <v-row class="mt-5 mb-2">
        <v-col cols="10">
          <div class="Montserrat-Bold titleBig text-justify">Englose realizado con éxito</div>
        </v-col>
        <v-col cols="2" align="right">
          <v-icon color="#393B44" large>mdi-check-all</v-icon>
        </v-col>
      </v-row>
      <v-divider color="#393B44" class="my-2"></v-divider>-->

      <div class="textHereSmall Montserrat-Regular my-4 mr-2">
          {{ this.$store.getters.get_englose.data }}
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
      </v-row>
    </v-card>
  </v-dialog>
</template>

<script>
import Titulo from "../../components/Titulo";
export default {
  name: "ModalExitoEnglose",
  components: {Titulo},
  props: {
    show: { type: Boolean, default: false },
  },

   methods: {
    close() {
      this.$emit("close");
      this.$router.go(0);
    },
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
