<template>
  <div>
    <v-card color="grey lighten-3" class="my-6 px-4 pa-5">
      <div class="descripcion text-justify pb-2"> <strong>Búsqueda</strong> </div>
      <v-row>
        <v-col cols="12" xs="12" lg="4">
          <v-text-field
              append-icon="mdi-magnify"
              v-model="nro_expediente"
              label="N° DE EXPEDIENTE "
              outlined
              hide-details
              class="Montserrat-Regular text-justify"
              color="amber accent-4"
          />
        </v-col>

        <v-col cols="12" xs="12" lg="4">
          <v-autocomplete
              append-icon="mdi-magnify"
              class="Montserrat-Regular text-justify"
              color="amber accent-4"
              item-text="descripcion"
              v-model="motivo"
              :items="get_motivos"
              outlined
              label="TRÁMITE"
              item-color="amber accent-4"
              hide-details
          ></v-autocomplete>
        </v-col>

        <v-col cols="12" xs="12" lg="4">
          <v-text-field color="amber accent-4" v-model="search" append-icon="mdi-magnify"
                        label="INICIADOR, FECHA , FOJAS  "
                        hide-details
                        outlined
          />
        </v-col>

      </v-row>
    </v-card>

    <v-data-table
        :page.sync="page"
        hide-default-footer
      :headers="headers"
      :items="data"
      :search="search"
      :items-per-page="5"
      disable-sort
      mobile-breakpoint="300"
      class="elevation-1 mytable"
      loading-text="Cargando expedientes. Por favor, espere."
      :loading="loading"
        @page-count="pageCount = $event"
      no-data-text="No tienes Expedientes"
    >
      <template v-slot:item.prioridad="{ item }">
        <v-chip :color="getColor(item.prioridad)">
          <v-icon size="20px" class="mr-1">{{
            getIcon(item.prioridad)
          }}</v-icon>
          <h5 class="font-weight-regular">{{ item.prioridad }}</h5>
        </v-chip>
      </template>

      <template v-slot:item.action1="{ item }">
        <v-btn @click="verDetalleCedula(item)" fab small color="#FACD89" depressed>
          <v-icon> mdi-card-account-details </v-icon>
        </v-btn>
      </template>

      <template v-slot:item.action="{ item }">
        <v-btn @click="AbrirModalCedula(item)" fab small color="#FACD89" depressed>
          <v-icon> mdi-credit-card-plus </v-icon>
        </v-btn>
      </template>
    </v-data-table>

    <div v-if="pageCount > 0" class="text-center pt-2">
      <v-pagination
          v-model="page"
          :length="pageCount"
          :total-visible="7"
          color="amber accent-4 pb-2"
      ></v-pagination>
    </div>

    <v-overlay :value="this.$store.getters.get_detalle_loading">
      <v-progress-circular indeterminate size="60"></v-progress-circular>
    </v-overlay>
    <modal-nueva-cedula :show="show_modal" :datos="this.datos"/>
    <modal-detalle-cedula :show="get_show_detalle" :datos="get_detalle"/>
  </div>
</template>

<script>
import ModalNuevaCedula from "../../components/dialogs/ModalNuevaCedula";
import ModalDetalleCedula from "../dialogs/ModalDetalleCedula";
import {mapActions, mapGetters} from "vuex";

export default {
  components: { ModalNuevaCedula, ModalDetalleCedula},
  props: {
    data: Array,
    loading: { type: Boolean, default: false },
  },

  data() {
    return {

      page: 1,
      pageCount: 0,

      nro_expediente: '',
      motivo:'',

      headers: [
        {text: 'Prioridad', value: 'prioridad'},
        {text: 'N° de Expediente', value: 'nro_expediente',filter: this.nroExpedienteFilter},
        {text: 'Extracto', value: 'extracto'},
        {text: 'Fecha Creación', value: 'fecha_creacion'},
        {text: 'Trámite', value: 'tramite', widh: "5%", filter:this.motivoFilter},
        {text: 'Cuerpo', value: 'cant_cuerpos'},
        {text: 'Fojas', value: 'fojas'},
        {text: 'Detalle', value: 'action1', align: 'center', sortable: false},
        {text: 'Agregar', value: 'action', align: 'center', sortable: false},
        {class: "display-4"},
      ],

      show_modal: false,
      show_detalle: false,
      selected: [],
      search: "",
      datos:{
        id: '',
        nro_expediente: '',
        extracto: '',
      },
    };
  },

  computed: {
    ... mapGetters(['get_detalle', 'get_detalle_loading', 'get_show_detalle','get_motivos','get_areas_filtros'])
  },

  mounted() {
    this.index_filtros();
  },

  methods: {
    ...mapActions([
      'verDetalle', 'index_filtros'
    ]),

    getColor(prioridades) {
      if (prioridades === "alta") return "red lighten-3";
      if (prioridades === "normal") return "grey lighten-2";
    },

    getIcon(prioridades) {
      if (prioridades === "alta") return "mdi-exclamation-thick";
      else return "mdi-check-bold";
    },


    AbrirModalCedula(item) {
      this.datos.id = item.expediente_id,
      this.datos.nro_expediente = item.nro_expediente,
      this.datos.extracto = item.extracto,
      this.show_modal = true;
    },

    verDetalleCedula(item){
      let exp = {
        expediente_id: item.expediente_id,
      }
      this.get_show_detalle = !this.get_show_detalle;
      this.verDetalle (exp)
    },

    nroExpedienteFilter(value) {
      // If this filter has no value we just skip the entire filter.
      if (!this.nro_expediente) {
        return true;
      }

      // Check if the current loop value (The dessert name)
      // partially contains the searched word.
      return value.toLowerCase().includes(this.nro_expediente.toLowerCase());
    },

    /**
     * Filter for calories column.
     * @param value Value to be tested.
     * @returns {boolean}
     */
    motivoFilter(value) {

      // If this filter has no value we just skip the entire filter.
      if (!this.motivo) {
        return true;
      }

      // Check if the current loop value (The calories value)
      // equals to the selected value at the <v-select>.
      return value === this.motivo;
    },
  },
};
</script>

<style>
.v-data-table > .v-data-table__wrapper > table > thead > tr > th > span {
  font-size: 19px !important;
}

.mytable thead {
  background-color: #facd89 !important;
  font-family: "Montserrat-Regular", serif !important;
}

.v-data-table > .v-data-table__wrapper > table > tbody > tr > td {
  font-family: "Montserrat-Regular", serif !important;
  font-size: 17px !important;
  padding: 12px !important;
}

.v-data-table > .v-data-table__wrapper > table > tbody > tr:hover {
  background-color: #fae3bf !important;
}
</style>
