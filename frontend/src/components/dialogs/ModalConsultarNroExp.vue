<template>
  <v-dialog persistent v-model="show" width="900" content-class="round">
    <div v-if="this.get_encontrado === false">

      <v-card class="px-7 pt-1 pb-6">

        <div class="d-flex justify-space-between mb-6">
          <h2 class="Montserrat-Bold text-justify textRadioTitlte">
            Consultar Expediente por N° Expediente:
          </h2>

          <v-btn @click="close" icon elevation="0" color="grey lighten-2">
            <v-icon left large color="#393B44"> mdi-close-thick </v-icon>
          </v-btn>
        </div>

        <v-divider color="#393B44" class="mt-2"></v-divider>

          <v-form ref="form" v-model="valid">
            <v-text-field class="Montserrat-Regular text-justify" color="amber accent-4" v-model="busqueda.valor" :rules="nameRules" outlined></v-text-field>

                    <v-btn :disabled="!valid" @click="validate" class="pa-5 color Montserrat-SemiBold" height="45" color="#FACD89">
                      <v-icon class="pr-4"> mdi-magnify </v-icon>
                      Buscar
                    </v-btn>
          </v-form>

      </v-card>
    </div>

    <div v-if="this.get_encontrado">

      <v-card class="px-7 pt-1 pb-6">
        <v-row class="mt-5">
          <v-col cols="10">
            <h2 class="Montserrat-Bold text-justify">Resultados Obtenidos</h2>
          </v-col>
          <v-col cols="2" align="right">
            <v-btn @click="close" icon elevation="0" color="grey lighten-2">
              <v-icon left large color="#393B44"> mdi-close-thick </v-icon>
            </v-btn>
          </v-col>
        </v-row>

        <v-divider color="#393B44" class="mt-2"></v-divider>

        <div v-if="this.get_resultado.length === 0">
          <div class="descripcion mt-4 py-2">
            No se han encontrado resultados
          </div>
        </div>

        <div v-if="this.get_resultado.length > 0 || this.get_resultado[1] == 1">
          <div class="descripcion mt-4 py-2">
            Haga click en el resultado para más detalles
          </div>

          <!-- muestra los englosados padre e hijo -->
          <div v-if="get_resultado[2] === 1">
            <v-expansion-panels focusable>
              <v-expansion-panel class="my-2">
                <v-expansion-panel-header
                  color="#FACD89"
                  class="Montserrat-SemiBold sizeNroExp"
                >
                  El expediente {{ get_resultado[1].nro_expediente }}, se
                  encuentra acumulado en el
                  {{ get_resultado[0].nro_expediente }}
                </v-expansion-panel-header>

                <v-row>
                  <v-col cols="6">
                    <v-expansion-panel-content>
                      <div class="Montserrat-Bold mt-4">
                        DATOS EXPEDIENTE {{ get_resultado[0].nro_expediente }}
                      </div>
                      <div class="Montserrat-Bold mt-4">Iniciador:</div>
                      <div class="Montserrat-Regular">
                        {{ get_resultado[0].iniciador }}
                      </div>

                      <div class="Montserrat-Bold mt-4">CUIT:</div>
                      <div class="Montserrat-Regular">
                        {{ get_resultado[0].cuit }}
                      </div>

                      <div class="Montserrat-Bold mt-4">Extracto:</div>
                      <div class="Montserrat-Regular">
                        {{ get_resultado[0].extracto }}
                      </div>

                      <div class="Montserrat-Bold mt-4">Área Actual:</div>
                      <div class="Montserrat-Regular">
                        {{ get_resultado[0].area_actual }}
                      </div>

                      <v-btn
                        class="mt-6"
                        @click="historial_pase(get_resultado[0])"
                        depressed
                      >
                        <v-icon left size="25px"> mdi-magnify </v-icon>
                        Ver Historial
                      </v-btn>
                    </v-expansion-panel-content>
                  </v-col>

                  <v-divider class="my-6" vertical></v-divider>

                  <v-col cols="6">
                    <v-expansion-panel-content>
                      <div class="Montserrat-Bold mt-4">
                        DATOS EXPEDIENTE {{ get_resultado[1].nro_expediente }}
                      </div>
                      <div class="Montserrat-Bold mt-4">Iniciador:</div>
                      <div class="Montserrat-Regular">
                        {{ get_resultado[1].iniciador }}
                      </div>

                      <div class="Montserrat-Bold mt-4">CUIT:</div>
                      <div class="Montserrat-Regular">
                        {{ get_resultado[1].cuit }}
                      </div>

                      <div class="Montserrat-Bold mt-4">Extracto:</div>
                      <div class="Montserrat-Regular">
                        {{ get_resultado[1].extracto }}
                      </div>

                      <v-btn
                        class="mt-6"
                        @click="historial_pase(get_resultado[1])"
                        depressed
                      >
                        <v-icon left size="25px"> mdi-magnify </v-icon>
                        Ver Historial
                      </v-btn>
                    </v-expansion-panel-content>
                  </v-col>
                </v-row>
              </v-expansion-panel>
            </v-expansion-panels>
          </div>

          <div v-else>
            <v-expansion-panels focusable>
              <v-expansion-panel
                class="my-2"
                v-for="item in get_resultado"
                :key="item.id"
              >
                <v-expansion-panel-header
                  color="#FACD89"
                  class="Montserrat-SemiBold sizeNroExp"
                >
                  {{ item.nro_expediente }}
                </v-expansion-panel-header>

                <v-expansion-panel-content>
                  <div class="Montserrat-Bold mt-4">Iniciador:</div>
                  <div class="Montserrat-Regular">{{ item.iniciador }}</div>
                  <div class="Montserrat-Regular">{{ item.apellido }}</div>

                  <div class="Montserrat-Bold mt-4">CUIT:</div>
                  <div class="Montserrat-Regular">{{ item.cuit }}</div>

                  <div v-if="(item.cuil !== null)  && (item.cuil !== '-') " >
                  <div class="Montserrat-Bold mt-4">CUIL:</div>                  
                  <div class="Montserrat-Regular">{{ item.cuil }}</div>
                  </div>              

                  <div class="Montserrat-Bold mt-4">Extracto:</div>
                  <div class="Montserrat-Regular">{{ item.extracto }}</div>

                  <div class="Montserrat-Bold mt-4">Área Actual:</div>
                  <div class="Montserrat-Regular">{{ item.area_actual }}</div>

                  <v-btn class="mt-6" @click="historial_pase(item)" depressed>
                    <v-icon left size="25px"> mdi-magnify </v-icon>
                    Ver Historial
                  </v-btn>
                </v-expansion-panel-content>
              </v-expansion-panel>
            </v-expansion-panels>
          </div>
        </div>

        <!-- <div v-if="this.get_resultado.length > 0">
          <div class="descripcion mt-4 py-2">
            12312
          </div>
        </div> -->

      </v-card>
    </div>
  </v-dialog>
</template>

<script>
//import TextField from "../TextField";
import { mapActions, mapGetters } from "vuex";

export default {
  name: "ModalConsultarNroExp",
  //components: { TextField },

  props: {
    show: Boolean,
  },

  data() {
    return {
      valid: true,
      buscador: null,
      resultados: false,
      showBuscar: false,
      opcion_elegida: "",
      busqueda: {
        buscar_por: 1,
        valor: "",
      },
      states: [{ name: "Con resultados" }, { name: "Sin resultados" }],

      nameRules: [
        (v) => !!v || "El campo es Requerido",
        //(v) => (v > 14) || "El máximo de fojas es 1000",
      ],
    };
  },

  computed: mapGetters([
    "get_resultado",
    "get_encontrado",
    "get_historial",
    "get_user",
  ]),

  methods: {
    ...mapActions(["consultarExpediente", "historial_expediente"]),

    close() {
      this.$emit("close");
      this.$router.go(0);
    },

    validate() {
      if (this.$refs.form.validate()) {
        this.consultarExpediente(this.busqueda);
      }
    },

    historial_pase: function (item) {
      let id = {
        id: item.id,
      };
      this.historial_expediente(id);
    },

  },
};
</script>

<style>
.textRadio {
  font-family: Montserrat-SemiBold, serif;
  font-size: 18px !important;
  color: #393b44;
}

.sizeNroExp {
  font-size: 20px !important;
}

@media (max-width: 600px) {
  .textRadio {
    font-size: 15px !important;
  }
  .sizeIcon {
    display: none !important;
  }
  .textRadioTitlte {
    font-size: 25px;
  }
}
</style>
