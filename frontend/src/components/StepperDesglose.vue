<template>
  <div class="pb-12">
    <v-stepper v-model="paso" class="mb-16 mt-4">
      <v-card color="#facd89" class="Montserrat-Regular text-justify">
        <v-stepper-header>
          <v-stepper-step
            :complete="paso > 1"
            step="1"
            color="grey darken-3"
          >
            Seleccione el expediente a desglosar
          </v-stepper-step>

          <v-stepper-step
            color="grey darken-3"
            :complete="paso > 2"
            step="2"
          >
            Expediente seleccionado
          </v-stepper-step>
        </v-stepper-header>
      </v-card>

      <v-stepper-items>
        <v-stepper-content step="1">
            <v-expansion-panels>
              <v-expansion-panel
                class="my-2"
                v-for="item in data"
                :key="item.id"
              >
                <v-expansion-panel-header
                  color="grey lighten-3"
                  class="Montserrat-SemiBold sizeNroExp"
                >
                  {{ item.nro_expediente }}

                </v-expansion-panel-header>

                <v-expansion-panel-content>
                  <div class="Montserrat-Bold contentSize mt-4">EXTRACTO:</div>
                  <div class="Montserrat-Regular contentSize">{{ item.extracto }}</div>

                  <v-btn class="mt-6 Montserrat-SemiBold" @click="verHijos(item)" depressed color="#FACD89">
                    <v-icon left size="25px"> mdi-arrow-right-thick </v-icon>
                    Seleccionar
                  </v-btn>
                </v-expansion-panel-content>
              </v-expansion-panel>
            </v-expansion-panels>
            <v-overlay :value="this.$store.getters.get_consulta_loading">
              <v-progress-circular indeterminate size="60"></v-progress-circular>
            </v-overlay>
        </v-stepper-content>

      <v-stepper-content step="2">
        <v-card class="mx-auto" tile>
            <div class="contentSize Montserrat-Bold"> EXPEDIENTE PRINCIPAL:
              <div class="subSize Montserrat-Bold mt-2 amber--text text--accent-4" v-text="exp_padreSeleccionado.nro_expediente"/>
              <div class="contentSize Montserrat-Regular mt-2">{{ exp_padreSeleccionado.extracto }}</div>
            </div>

            <v-divider class="my-4"></v-divider>

            <div class="contentSize Montserrat-Bold mb-2"> EXPEDIENTES ENGLOSADOS:
                <div class="subSize Montserrat-Bold mt-2 amber--text text--accent-4"  v-for="item in getExpedientesHijos" :key="item.id" v-text="item.nro_expediente"/>
            </div>

          <v-row justify="center" class="contentSize Montserrat-Regular py-6" align="center">
                <v-col cols="4">
                  <v-btn
                    @click="paso = 1"
                    class="pa-5 Montserrat-SemiBold"
                    height="50"
                    elevation="0"
                    block
                  >
                    <v-icon class="pr-5"> mdi-arrow-left </v-icon>
                    <div>Volver</div>
                  </v-btn>
                </v-col>
                <v-col cols="4">
                  <v-btn
                    @click="confirmarDesglose"
                    :disabled="this.$store.getters.get_consulta_loading"
                    class="pa-1 color Montserrat-SemiBold px-6"
                    height="50"
                    elevation="0"
                    color="#FACD89"
                    block
                  >
                    <v-icon class="pr-5"> mdi-check-bold </v-icon>
                    <div>Confirmar</div>
                  </v-btn>
                </v-col>
              </v-row>
        </v-card>
      </v-stepper-content>
      </v-stepper-items>
    </v-stepper>

    <modal-exito-desglose :show="get_show_desglose" />
    <v-overlay :value="this.$store.getters.get_consulta_loading">
        <v-progress-circular indeterminate size="60"></v-progress-circular>
    </v-overlay>
  </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex";
import ModalExitoDesglose from './../components/dialogs/ModalExitoDesglose';

export default {
  components:{ModalExitoDesglose},

  props: {
    headers: Array,
    data: Array,
    loading: {type: Boolean, default: false},
  },

  data() {
    return {
      seleccionados: [],
      search: "",
      exp_padreSeleccionado: '',
      id_padre: '',
      paso: 1,
    };
  },

  computed: mapGetters(['getExpedientesHijos','getExpedientesPadres', 'get_consulta_loading', 'get_show_desglose']),

  methods: {
    ...mapActions([
      'desglosarVerHijos',
      'desglose'
    ]),

    confirmarDesglose(){
      let expedientes_desglose = {
        exp_padre: this.id_padre,
      }
      this.desglose(expedientes_desglose)
      this.get_show_desglose != this.get_show_desglose
    },

    quitar (item){
      this.seleccionados.splice(item)
    },

    verHijos: function (item) {
      this.id_padre = item.id,
      this.paso = 2

      this.exp_padreSeleccionado = {
        nro_expediente: item.nro_expediente,
        extracto: item.extracto,
      };

      let expedientePase = {
        exp_padre : item.id
      }
      this.desglosarVerHijos(expedientePase)
    },
  },
};
</script>

<style>
.subSize{
  font-size: 22px ;
}

.contentSize{
  font-size: 20px;
}
</style>
