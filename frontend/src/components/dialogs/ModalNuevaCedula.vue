<template>
  <v-dialog v-model="show" width="1200" content-class="round" persistent>
    <div v-if="this.get_cargado === false">
        <v-card class="px-7 pt-1 pb-6">
          <v-row class="mt-5">
            <v-col cols="10">
              <h2 class="Montserrat-Bold text-justify ">
                Agregar Cédula al Expediente N°{{ this.datos.nro_expediente }}
              </h2>
            </v-col>
            <v-col cols="2" align="right" class="iconoMobile">
              <v-icon left large color="#393B44"> mdi-credit-card-plus </v-icon>
            </v-col>
          </v-row>

          <v-divider color="#393B44" class="mt-2"></v-divider>

          <v-row no-gutters class="py-5">
            <v-col cols="12" sm="12" lg="12">
              <div class="fontSmall Montserrat-SemiBold mr-3">Extracto:</div>
            </v-col>
            <v-col cols="12" sm="12" lg="12" align="center">
              <div class="fontSmall Montserrat-Regular text-justify">
                {{ this.datos.extracto }}
              </div>
            </v-col>
          </v-row>

          <form>
            <div>
              <div class="Montserrat-SemiBold sizeCedula mt-4 mb-1 py-2">
                Ingrese el nuevo número de cédula para el expediente:
              </div>
              <label-error :texto="this.get_error"/>
              <text-field class="py-2" v-model="valorCedula" tipo="number"/>

              <v-row no-gutters justify="center" class="py-3">             
                <v-col cols="12" sm="6" class="px-sm-2">
                  <v-btn
                    @click="close"
                    class="pa-5 color Montserrat-SemiBold ma-2"
                    height="55"
                    elevation="0"
                    color="#FACD89"
                    block
                  >
                    <v-icon class="pr-5"> mdi-close-thick </v-icon>
                    Cerrar
                  </v-btn>
                </v-col>
                <v-col cols="12" sm="6" class="px-sm-2">
                  <v-btn
                    @click="save()"
                    class="pa-5 color Montserrat-SemiBold ma-2"
                    height="55"
                    color="#FACD89"
                    block
                  >
                    <v-icon class="pr-5"> mdi-content-save </v-icon>
                    Guardar
                  </v-btn>
                </v-col>
              </v-row>
            </div>
          </form>
        </v-card>
      </div>

      <div v-else>
        <v-card class="px-7 pt-1 pb-6">
          <v-row class="mt-5">
            <v-col cols="12">
              <h2 class="Montserrat-Bold text-justify">
                Se guardó con éxito el N° de Cédula
              </h2>
            </v-col>
          </v-row>

          <v-divider color="#393B44" class="mt-2"></v-divider>
          <v-row class="Montserrat-Regular sizeCedula mb-1 py-4">
            <v-col cols="12" md="6" sm="12">
              <div class="sizeTextSmall Montserrat-SemiBold pt-4">N° de Expediente: <span class="sizeTextSmall Montserrat-Regular"> {{getCedula.nro_expediente}} </span></div>
            </v-col>
            <v-col cols="12" md="6" sm="12">
              <div class="sizeTextSmall Montserrat-SemiBold pt-4">N° de Cédula: <span class="sizeTextSmall Montserrat-Regular">  {{ getCedula.descripcion }} </span></div>
            </v-col>
            <v-col cols="12">
              <div class="sizeTextSmall Montserrat-SemiBold pt-4">Extracto: <span class="sizeTextSmall Montserrat-Regular"> {{getCedula.extracto}} </span></div>
              <div class="sizeTextSmall Montserrat-SemiBold pt-6">Usuario: <span class="sizeTextSmall Montserrat-Regular"> {{ getCedula.user}} </span></div>
            </v-col>
          </v-row>

          <v-row no-gutters justify="center" class="py-3">             
            <v-col cols="12" sm="6" class="px-sm-2">
              <v-btn
                @click="close"
                class="pa-5 color Montserrat-SemiBold"
                height="55"
                elevation="0"
                color="#FACD89"
                block
              >
                <v-icon class="pr-5"> mdi-close-thick </v-icon>
                Cerrar
              </v-btn>
            </v-col>
          </v-row>
        </v-card>
      </div>

  </v-dialog>
</template>

<script>
import TextField from "../TextField";
import { mapActions, mapGetters } from "vuex";
import LabelError from "../../components/LabelError";

export default {
  name: "ModalNuevaCedula",
  components: { TextField, LabelError },
  props: {
    show: { type: Boolean, default: false },
    datos: Object,
  },

  data() {
    return {
      valorCedula: "",
    };
  },

  computed: mapGetters(["get_cargado", "get_error", 'getCedula']),

  methods: {
    ...mapActions([ "storeCedula"]),

    save() {
      let exp = {
        expediente_id: this.datos.id,
        descripcion: this.valorCedula,
      };
      this.storeCedula(exp);
    },

    close() {
      this.$emit("close");
      this.$router.go(0);
    },
  },
};
</script>
<style>
.sizeCedula {
  font-size: 22px !important;
}
</style>