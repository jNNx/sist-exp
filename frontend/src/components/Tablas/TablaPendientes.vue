<template>
  <div>

    <v-card color="grey lighten-3" class="my-6 px-4 pa-5">
      <div class="descripcion text-justify pb-2"> <strong>Búsqueda</strong> </div>
      <v-row>
        <v-col cols="12" xs="12" lg="3">
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

        <v-col cols="12" xs="12" lg="3">
          <v-autocomplete
              append-icon="mdi-magnify"
              class="Montserrat-Regular text-justify"
              color="amber accent-4"
              item-text="nombre"
              v-model="area"
              :items="get_areas_filtros"
              outlined
              label="ÁREA ORIGEN"
              item-color="amber accent-4"
              hide-details
          ></v-autocomplete>
        </v-col>

        <v-col cols="12" xs="12" lg="3">
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

        <v-col cols="12" xs="12" lg="3">
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
          @page-count="pageCount = $event"
          :headers="headers"
          :items="items"
          :search="search"
          :items-per-page="5"
          disable-sort
          mobile-breakpoint="300"
          class="elevation-1 mytable"
          v-model="selected"
          loading-text="Cargando expedientes. Por favor, espere."
          :loading="loading"
          no-data-text="No hay Expedientes Pendientes por aceptar"
      >

        <template v-slot:item.prioridad="{ item }">
          <v-chip
              :color="getColor(item.prioridad)"
          >
            <v-icon size="20px" class="mr-1">{{getIcon(item.prioridad)}}</v-icon><h5 class="font-weight-regular">{{ item.prioridad }}</h5>
          </v-chip>
        </template>

        <template v-slot:item.action1= "{item}">
          <v-btn @click="detalle(item)" fab small color="#FACD89" depressed>
            <v-icon> mdi-eye </v-icon>
          </v-btn>
        </template>

        <template v-slot:item.action= "{item}">
          <v-btn @click="recibirI(item)" fab small color="#FACD89" depressed>
            <v-icon> mdi-check-bold </v-icon>
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

      <modal-ver-detalle-exp
            :datos="datosSeleccionado"
            :show="show_modal"
            @close="closeModal"
      />
  </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex";
import ModalVerDetalleExp from "../../components/dialogs/ModalVerDetalleExp";

export default {
  components: { ModalVerDetalleExp },
  props: {
    items: Array,
    loading: {type: Boolean, default: false},
  },

  data () {
    return {
      //filtros
      nro_expediente: '',
      motivo:'',
      area:'',

      //paginacion
      page: 1,
      pageCount: 0,


      selected:[],
      headers: [
        {text: 'Prioridad', value: 'prioridad'},
        {text: 'N° de Expediente', value: 'nro_expediente',filter: this.nroExpedienteFilter},
        {text: 'Extracto', value: 'extracto', width: "33%"},
        {text: 'Área Origen', value: 'area_origen', filter: this.areaActualFilter},
        {text: 'Trámite', value: 'tramite', widh: "5%", filter:this.motivoFilter},
        {text: 'Creación', value: 'fecha_creacion', width: "5%"},
        {text: 'Cuerpo', value: 'cant_cuerpos', align: 'center'},
        {text: 'Fojas', value: 'fojas', align: 'center'},
        {text: 'Detalle', value: 'action1', align: 'center', sortable: false},
        {text: 'Aceptar', value: 'action', align: 'center', sortable: false},
      ],
      search: '',
      show_modal: false,
      expediente_id:0,
      datosSeleccionado: {}
    }
  },

  computed: {
    ... mapGetters(['get_motivos','get_areas_filtros']),
  },

  mounted() {
    this.index_filtros();
  },

  methods: {
    ...mapActions([
      'cambiarEstado',
      'index_filtros'
    ]),


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

    areaActualFilter(value) {

      // If this filter has no value we just skip the entire filter.
      if (!this.area) {
        return true;
      }

      // Check if the current loop value (The calories value)
      // equals to the selected value at the <v-select>.
      return value === this.area;
    },

    getColor (prioridades) {
      if (prioridades === 'alta') return 'red lighten-3'
      if (prioridades === 'normal') return 'grey lighten-2'
    },
    getIcon (prioridades) {
      if (prioridades === 'alta') return 'mdi-exclamation-thick'
      else return 'mdi-check-bold'
    },

    recibirI (item) {
          item.estado_expediente = 3,
          item.estado= 1,
          item.bandeja= 1,
          this.cambiarEstado(item)
    },
    
    detalle(item) {
      this.datosSeleccionado = item
      this.show_modal = true;
    },

    closeModal() {
      this.show_modal = false;
    }
  },
}
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