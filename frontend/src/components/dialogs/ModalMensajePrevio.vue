<template>
  <!-- Falta conexion a la hora de poder crear un expedinte -->
  <v-dialog v-model="show" content-class="round" persistent>
    <v-card class="pa-8">

      <div style="font-size: 40px; color:#FB8C00" class="Montserrat-Bold py-2 text-center">
        Detalles del Expediente
      </div>
      <v-divider class="mb-3" color="#393B44"></v-divider>

        <!--INICIADOR-->
        <div class="d-flex flex-row">
          <v-icon class="mr-4" size="50" color="#FB8C00">mdi-account-multiple</v-icon>
          <div>
            <div style="font-size: 26px; color:#FB8C00" class="textTitle flex-column Montserrat-Bold"> INICIADOR:</div>
            <div style="font-size: 24px; font-weight: bold" class="textHereSmall Montserrat-Regular">{{ dato.iniciador }}</div>
          </div>
        </div>

        <v-divider color="#393B44" class="my-4"></v-divider>

        <!--MOTIVO-->
        <div class="d-flex flex-row">
          <v-icon class="mr-4" size="50" color="#FB8C00">mdi-file-document-edit</v-icon>
          <div>
            <div style="font-size: 26px; color:#FB8C00" class="textTitle flex-column Montserrat-Bold">MOTIVO:</div>
            <div style="font-size: 24px;font-weight: bold" class="textHereSmall Montserrat-Regular">{{ dato.motivo }}</div>
          </div>
        </div>

        <v-divider color="#393B44" class="my-4"></v-divider>

        <!--EXTRACTO-->
        <div class="d-flex flex-row">
          <v-icon class="mr-4" size="50" color="#FB8C00">mdi-file-document</v-icon>
          <div>
            <div style="font-size: 26px; color:#FB8C00" class="textTitle flex-column Montserrat-Bold"> EXTRACTO:</div>
            <div style="font-size: 26px; font-weight: bold" class="textHereSmall Montserrat-Regular">{{ get_extracto }}</div>
          </div>
        </div>


        <!--NRO SIIF-->
        <div  v-if="!(expe.nro_expediente_ext === '')">
          <v-divider color="#393B44" class="my-4"></v-divider>
          <div class="d-flex flex-row">
            <v-icon class="mr-4" size="50" color="#FB8C00">mdi-numeric</v-icon>
            <div>
              <div style="font-size: 26px; color:#FB8C00" class="textTitle flex-column Montserrat-Bold"> NÚMERO SIIF:</div>
              <div style="font-size: 26px; font-weight: bold" class="textHereSmall Montserrat-Regular">{{ expe.nro_expediente_ext }}</div>
            </div>
          </div>
        </div>

        <v-divider color="#393B44" class="my-4"></v-divider>

        <!--CANTIDAD DE FOJAS-->
        <div class="d-flex flex-row">
          <v-icon class="mr-4" size="50" color="#FB8C00">mdi-text-long</v-icon>
          <div>
            <div style="font-size: 26px; color:#FB8C00" class="textTitle flex-column Montserrat-Bold"> FOJAS:</div>
            <div style="font-size: 26px; font-weight: bold" class="textHereSmall Montserrat-Regular">{{ expe.nro_fojas }}</div>
          </div>
        </div>

        <v-divider color="#393B44" class="my-4"></v-divider>

        <!--OBSERVACIONES-->
        <div class="flex-row">
          <div v-if="expe.observacion === ''">
            <div style="font-size: 26px; color:#FB8C00" class="textTitle flex-column Montserrat-Bold"><v-icon class="mr-4" size="50" color="#FB8C00">mdi-text-box-search</v-icon> OBSERVACION:</div>
            <div style="font-size: 26px; font-weight: bold" class="textHereSmall Montserrat-Regular"> - </div>
          </div>

          <div v-else>
              <div style="font-size: 26px; color:#FB8C00" class="textTitle flex-column Montserrat-Bold"><v-icon class="mr-4" size="50" color="#FB8C00">mdi-text-box-search</v-icon> OBSERVACION:</div>
              <div style="font-size: 26px; font-weight: bold" class="textHereSmall Montserrat-Regular"> {{ expe.observacion }} </div>
          </div>
        </div>

        <v-divider color="#393B44" class="my-4"></v-divider>

        <!--PASE A-->
        <div class="d-flex flex-row">
          <v-icon class="mr-4" size="50" color="#FB8C00">mdi-home</v-icon>
          <div>
            <div style="font-size: 26px; color:#FB8C00" class="textTitle flex-column Montserrat-Bold">PASE DESTINADO A:</div>
            <div style="font-size: 26px; font-weight: bold" class="textHereSmall Montserrat-Regular"> {{ dato.pasea }} </div>
          </div>
        </div>


      <v-row no-gutters justify="center" class="mt-6">
        <v-col cols="12" sm="6" md="6" lg="6" class="py-6 px-sm-2">
          <v-btn @click="storeExpe" class="pa-5 color Montserrat-SemiBold"
              height="55"
              elevation="0"
              color="#FACD89"
              block
              :disabled="this.$store.getters.get_btn_creado"
          >
            <v-icon class="mr-2">mdi-check-bold</v-icon>
            Confirmar
          </v-btn>
        </v-col>

        <v-col cols="12" sm="6" md="6" lg="6" class="py-6 px-sm-2">
          <v-btn
              outlined
              @click="close"
              class="pa-5 Montserrat-SemiBold"
              height="55"
              elevation="0"
              color="#FACD89"
              block
          >
            <v-icon class="mr-2"> mdi-close-thick</v-icon>
            Modificar
          </v-btn>
        </v-col>

      </v-row>
    </v-card>
  </v-dialog>
</template>

<script>
//import Titulo from "../../components/Titulo";
import {mapActions, mapGetters} from "vuex";

export default {
  name: "ModalMensajePrevio",
  //components: {Titulo},
  props: {
    show: Boolean,
    dato: {
      type: Object,
      default: () => ({
        iniciador: 'no hay dato',
        motivo: 'no hay dato',
        pasea: 'no hay dato'
      })
    },
    expe: {
      type: Object,
      default: () => ({})
    }
  },

  computed: {
    ...mapGetters([
      'get_error_modal_preview',
      'get_extracto'
    ]),
  },

  methods: {
    ...mapActions(["getArchivos", 'storeExpediente', 'extracto']),

    storeExpe() {
      let formData = new FormData();
      for (var i = 0; i < this.dato.files_length; i++) {
        let file = this.files[i];

        formData.append("archivo" + i + "", file);
      }
      let cantidad = this.dato.files_length
      formData.append("iniciador_id", this.expe.iniciador_id);
      formData.append("nro_fojas", this.expe.nro_fojas);
      formData.append("nro_expediente_ext", this.expe.nro_expediente_ext);
      formData.append("observacion", this.expe.observacion);
      formData.append("prioridad_id", this.expe.prioridad);
      formData.append("tipo_exp_id", this.expe.tipo_exp_id);
      formData.append("descripcion_extracto", this.get_extracto);
      formData.append("area_id", this.expe.area_id);
      formData.append("archivos_length", cantidad);

      this.storeExpediente(formData);
    },

    close() {
      this.$emit("close_mensaje_previo");
    },
  },

  extracto: {
    get() {
      return this.$store.getters.extracto;
    },
  },
};
</script>

<style>
.textExtracto {
  font-size: 28px !important;
}
</style>
