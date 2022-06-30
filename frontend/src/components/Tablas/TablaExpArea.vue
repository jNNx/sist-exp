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
                <v-text-field
                    append-icon="mdi-magnify"
                    v-model="users"
                    label="USUARIO"
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
                <v-text-field
                    color="amber accent-4"
                    v-model="search"
                    append-icon="mdi-magnify"
                    label="INICIADOR, FECHA"
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
            loading-text="Cargando expedientes del área. Por favor, espere."
            :loading="loading"
            no-data-text="No hay expedientes en el área"
            @page-count="pageCount = $event"
        >

            <template v-slot:item.action="{item}">
                <v-btn @click="tomar(item)" :disabled="get_user.nombre_apellido==item.nombre_apellido" fab small color="#FACD89" depressed >
                    <v-icon>mdi-hand-extended</v-icon>
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

        <modal-tomar-exp :show="get_show_modal_tomar_exp" :dato="datosExpTomar" @close_modal="closeModal"/>
    </div>
</template>

<script>
import ModalTomarExp from "../../components/dialogs/ModalTomarExp";
import {mapActions, mapGetters} from "vuex";
export default {
  components: { ModalTomarExp },
  props: {
    data: Array,
    loading: { type: Boolean, default: false },
  },
  data () {
    return {
      headers: [
        {text: 'N° de Expediente', value: 'nro_expediente', filter: this.nroExpedienteFilter},
        {text: 'Extracto', value: 'extracto'},
        {text: 'Creación', value: 'fecha_creacion' },
        {text: 'Trámite', value: 'tramite', filter:this.motivoFilter},
        {text: 'Usuario', value: 'nombre_apellido', filter: this.usersFilter},
        {text: 'Tomar', value: 'action', align: 'center', sortable: false},
      ],

      page: 1,
      pageCount: 0,
      datosExpTomar: {},
      search: '',
      nro_expediente: '',
      users:'',
      motivo:'',
      
    }
  },

  computed: mapGetters(['get_show_modal_tomar_exp', 'get_user', 'get_motivos','get_user_filtros']),

  mounted() {
    this.index_filtros();
  },

  methods: {
    ...mapActions(['showModalTomarExp', 'index_filtros']),

    tomar (item) {
      this.datosExpTomar = item;
      this.showModalTomarExp(true)
    },

    closeModal() {
      this.showModalTomarExp(false)
    },

    nroExpedienteFilter(value) {
      if (!this.nro_expediente) {
        return true;
      }

      return value.toLowerCase().includes(this.nro_expediente.toLowerCase());
    },

    motivoFilter(value) {

      if (!this.motivo) {
        return true;
      }

      return value === this.motivo;
    },

    usersFilter(value) {
      if (!this.users) {
        return true;
      }
      return value.toLowerCase().includes(this.users.toLowerCase());
    },
  }
}
</script>
<style>
  .v-autocomplete.v-select--is-menu-active .v-input__icon--append .v-icon {
    transform: none;
  }
</style>