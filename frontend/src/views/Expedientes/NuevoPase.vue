<template>
  <div class="pb-16">
    <titulo texto="Nuevo Pase" icono="mdi-file-document" class="pb-5" />

    <v-btn
        class="pa-5 Montserrat-Bold mb-4"
        height="45"
        elevation="0"
        color="#FACD89"
        href="/mis-expedientes"
    >
      <v-icon class="mr-4"> mdi-arrow-left-bold</v-icon>
      <div class="pr-5"> VOLVER A PASES</div>

    </v-btn>

    <template>
      <form @submit.prevent="storePas()">
        <v-stepper v-model="e1" class="mb-16">
          <v-card color="#facd89" class="Montserrat-Regular text-justify">
            <v-stepper-header>
              <v-stepper-step color="grey darken-3" :complete="e1 > 1" step="1">
                Datos Expediente
              </v-stepper-step>
              <v-divider></v-divider>
              <v-stepper-step color="grey darken-3" :complete="e1 > 2" step="2">
                Detalle del Pase
              </v-stepper-step>
            </v-stepper-header>
          </v-card>

          <!--Primer Step-->
          <v-stepper-items>
            <v-stepper-content step="1">
              <v-card elevation="0" class="mb-12">
                <v-form ref="form">
                  <v-row class="my-n8">
                    <v-col cols="12" lg="6">
                      <!-- <label-error :texto="this.pase_a_error" /> -->
                    </v-col>

                    <v-col cols="12" lg="12">
                      <!-- <label-error /> -->
                      <label-input texto="Pase a:" />
                      <v-autocomplete
                        v-if="get_user.area === 'DPTO. MESA DE ENTRADAS Y SALIDAS' || get_user.area === 'ARCHIVO' "
                        class="Montserrat-Regular text-justify"
                        color="amber accent-4"
                        outlined
                        item-value="idd"
                        single-line
                        return-object
                        item-color="amber accent-4"
                        :items="get_areas_mesa_archivos"
                        item-text="descripcion"
                        v-model="areaSeleccionado"
                        :rules="paseRules"
                      >
                      </v-autocomplete>

                      <v-autocomplete
                          v-if="!(get_user.area === 'DPTO. MESA DE ENTRADAS Y SALIDAS' || get_user.area === 'ARCHIVO')"
                          class="Montserrat-Regular text-justify"
                          color="amber accent-4"
                          outlined
                          item-value="idd"
                          single-line
                          return-object
                          item-color="amber accent-4"
                          :items="get_areas"
                          item-text="descripcion"
                          v-model="areaSeleccionado"
                          :rules="paseRules"
                      >
                      </v-autocomplete>

                    </v-col>
                  </v-row>

                  <v-row class="my-n7">
                    <v-col cols="12" lg="6">
                      <!-- <label-error :texto="this.a_afectosde_error" /> -->
                    </v-col>
                    <v-col cols="12" lg="12">
                      <label-input texto="A efectos de:" />
                      <v-textarea
                        v-model="pase.observacion"
                        outlined
                        name="textarea"
                        :rules="motivoRules"
                        color="amber accent-4"
                      ></v-textarea>
                    </v-col>
                    <!-- <label-error /> -->
                  </v-row>

                  <v-row class="justify-end my-n7">
                    <v-col cols="12" lg="4">
                      <!-- <label-error :texto="this.nrofojas_error" /> -->
                    </v-col>
                  </v-row>

                  <v-row>
                    <v-col cols="12" lg="4">
                      <label-input texto="Fecha y hora del pase" />
                      <v-text-field
                        class="Montserrat-Regular text-justify"
                        color="amber accent-4"
                        outlined
                        readonly
                        v-model="fecha"
                      ></v-text-field>
                    </v-col>

                    <v-col cols="12" lg="4">
                      <label-input texto="Agente que redacta el pase" />
                      <text-field
                        :readonly="true"
                        v-model="get_user.nombre_apellido"
                      />
                    </v-col>

                    <v-col cols="12" lg="4">
                      <label-input texto="Fojas" />
                      <v-text-field
                        v-model="pase.nro_fojas"
                        color="amber accent-4"
                        outlined
                        :rules="nameRules"
                      ></v-text-field>
                    </v-col>
                  </v-row>
                  <!-- <label-error /> -->

                  <v-card color="#FFF5E6" class="pa-5">
                    <label-input texto="Adjuntar Archivos al Pase" />
                    <input
                      type="file"
                      multiple
                      @change="handleFileUpload($event)"
                    />
                    <modal-error-tipo-archivo
                      :show="showArchivoError"
                      @close="closeModalErrorArchivo"
                    />
                  </v-card>
                </v-form>
              </v-card>

              <v-row justify="center" class="my-4">
                <v-col cols="4">
                  <v-btn
                    class="pa-5 Montserrat-Bold"
                    height="55"
                    elevation="0"
                    color="#FACD89"
                    block
                    @click="validate"
                  >
                    <div class="pr-5">Continuar</div>
                    <v-icon> mdi-arrow-right-bold </v-icon>
                  </v-btn>
                </v-col>
              </v-row>
            </v-stepper-content>

            <v-stepper-content step="2">
              <modal-detalle-pase :data="this.pase" :dataArea="this.areaSeleccionado" />
              <v-row justify="center" class="my-4">
                <v-col cols="12" lg="6" md="6" sm="6">
                  <v-btn
                    @click="e1 = 1"
                    class="pa-5 Montserrat-Bold"
                    height="55"
                    elevation="1"
                    block
                  >
                    <v-icon class="pr-5"> mdi-arrow-left-bold </v-icon>
                    <div>Volver</div>
                  </v-btn>
                </v-col>
                <v-col cols="12" lg="6" md="6" sm="6">
                  <v-btn
                    type="submit"
                    class="pa-5 Montserrat-Bold"
                    height="55"
                    elevation="0"
                    color="#FACD89"
                    block
                  >
                    <div class="pr-5">Confirmar Pase</div>
                    <v-icon> mdi-check-bold </v-icon>
                  </v-btn>
                </v-col>
              </v-row>
            </v-stepper-content>
          </v-stepper-items>
        </v-stepper>
      </form>

      <modal-exito-pase :show="creado_exito" :dato="expediente_exito" />
    </template>
  </div>
</template>
<script>
import LabelInput from "../../components/LabelInput";
import Titulo from "../../components/Titulo";
import { mapActions, mapGetters } from "vuex";
import TextField from "../../components/TextField";
import ModalDetallePase from "../../components/dialogs/ModalDetallePase";
import ModalExitoPase from "../../components/dialogs/ModalExitoPase";
import ModalErrorTipoArchivo from "../../components/dialogs/ModalErrorTipoArchivo";


export default {
  name: "NuevoPase",
  components: {
    Titulo,
    LabelInput,
    TextField,
    ModalDetallePase,
    ModalExitoPase,
    ModalErrorTipoArchivo,
  },
  data: () => ({
    e1: 1,
    areaSeleccionado: {},
    pase: {
      observacion: "",
      nro_fojas: '',
    },
    files: "",
    loader: null,
    valid: true,

    nameRules: [
      (v) =>
       Number.isInteger(Number(v)) || "Los valores solo pueden ser numéricos",
      (v) => v > -1 || "El valor no puede ser menor a 0",
      (v) => !!v || "El número de Fojas es Requerido",
      (v) => (v && v <= 1000) || "El máximo de fojas es 1000",
    ],
    motivoRules: [
      (v) => !!v || "El campo es Requerido",
      (v) =>
        (v && v.length <= 255) ||
        "El campo no puede tener más de 255 caracteres",
    ],
    paseRules: [
      (v) => (v && v.length == null) || "Seleccione un área de destino",
    ],
    showArchivoError: false,
  }),

  computed: {
    ...mapGetters([
      "creado_exito",
      "expediente_exito",
      "get_areas",
      "fecha",
      "getIdUser",
      "expedientePase",
      "idExpedientePase",
      "pasea_error",
      "a_afectosde_error",
      "nrofojas_error",
       'get_user',
        'get_areas_mesa_archivos'
    ]),
  },

  methods: {
    ...mapActions(["storePase"]),

    storePas() {
      let formData = new FormData();

      for (var i = 0; i < this.files.length; i++) {
        let file = this.files[i];

        formData.append("archivo" + i + "", file);
      }

      let cantidad = this.files.length.toString();
      formData.append("expediente_id", this.$store.getters.idExpedientePase);
      formData.append("fojas", this.pase.nro_fojas);
      formData.append("area_destino_id", this.areaSeleccionado.id);
      formData.append("observacion", this.pase.observacion);
      formData.append("archivos", null);
      formData.append("estado_expediente", 1);
      formData.append("archivos_length", cantidad);

      this.storePase(formData);
    },

    handleFileUpload(event) {
      this.files = event.target.files;
      for (var i = 0; i < this.files.length; i++) {
        if (event.target.files[i].type === "application/x-msdownload") {
          this.showArchivoError = !this.showArchivoError;
          event.target.value = null;
        }
      }
    },

    closeModalErrorArchivo() {
      this.showArchivoError = false;
    },

    validate() {
      if (this.$refs.form.validate()) {
        this.e1 = 2;
      }
    },
  },
};
</script>
