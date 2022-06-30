<template>
  <div class="pb-12">
    <v-row>
      <v-col cols="12" lg="4">
        <v-text-field
          color="#8D93AB"
          v-model="search"
          append-icon="mdi-magnify"
          label="Buscar"
          hide-details
          outlined
          class="py-6"
        />
      </v-col>
    </v-row>
    <v-row class="mb-16" justify="center">
      <v-col cols="12" xs="12" sm="12" md="12" lg="6">
        <v-data-table
          :headers="headers"
          :items="data"
          :search="search"
          :items-per-page="5"
          disable-sort
          mobile-breakpoint="300"
          class="elevation-1 mytable"
          loading-text="Cargando expedientes. Por favor, espere."
          :loading="loading"
          no-data-text="No tienes expedientes"
        >
          <template v-slot:item.action="{ item }">
            <v-tooltip bottom>
              <template v-slot:activator="{ on, attrs }">
                <div v-if="item.hijos != null">
                  <v-btn
                    @click="padre_asignar(item)"
                    fab
                    small
                    color="#FACD89"
                    depressed
                    v-bind="attrs"
                    v-on="on"
                  >
                    <v-icon>mdi-arrow-right-thick</v-icon>
                  </v-btn>
                </div>
                <div v-else>
                  <v-btn
                    @click="seleccionar(item)"
                    fab
                    small
                    depressed
                    color="#FACD89"
                  >
                    <v-icon>mdi-arrow-right-thick</v-icon>
                  </v-btn>
                </div>
              </template>
              <span>Posee exp acumulados</span>
            </v-tooltip>

            <v-dialog
              v-model="dialog"
              transition="dialog-top-transition"
              max-width="600"
            >
              <v-card>
                <v-toolbar color="#FACD89" dark>
                  <v-icon x-large>mdi-alert-circle</v-icon>
                  <v-row justify="center">
                    <h2 class="white--text">¡Oops!</h2>
                  </v-row>
                </v-toolbar>
                <div class="text-h6 pa-10 font-weight-regular">
                  El expediente ya se encuentra seleccionado!
                </div>
              </v-card>
            </v-dialog>

            <v-dialog
              v-model="dialog_ya_hay_padre"
              transition="dialog-top-transition"
              max-width="600"
            >
              <v-card>
                <v-toolbar color="#FACD89" dark>
                  <v-icon x-large>mdi-alert-circle</v-icon>
                  <v-row justify="center">
                    <h2 class="white--text">¡Oops!</h2>
                  </v-row>
                </v-toolbar>
                <div class="text-h6 pa-10 font-weight-regular">
                  No es posible acumular dos expedientes principales.
                </div>
              </v-card>
            </v-dialog>
          </template>
        </v-data-table>
      </v-col>

      <v-dialog
        v-model="dialog_posicion_padre"
        transition="dialog-top-transition"
        max-width="600"
      >
        <v-card>
          <v-toolbar color="#FACD89" dark>
            <v-icon x-large>mdi-alert-circle</v-icon>
            <v-row justify="center">
              <h2 class="white--text">¡Oops!</h2>
            </v-row>
          </v-toolbar>
          <div class="text-h6 pa-10 font-weight-regular">
            El expediente {{ padre_aux.nro_expediente }} ya tiene acumulado
            otros expedientes. ¿Desea ubicarlo en la primera posición?

            <v-row no-gutters justify="center" class="mt-6">
              <v-col cols="12" sm="6" md="6" lg="6" class="py-6 px-sm-2">
                <v-btn
                  @click="padre()"
                  class="pa-5 color Montserrat-SemiBold"
                  height="55"
                  elevation="0"
                  color="#FACD89"
                  block
                >
                  <v-icon class="mr-2">mdi-check-bold</v-icon>
                  Confirmar
                </v-btn>
              </v-col>

              <v-col cols="12" sm="6" md="6" lg="6" class="py-6 px-sm-2">
                <v-btn
                  outlined
                  @click="close()"
                  class="pa-5 Montserrat-SemiBold"
                  height="55"
                  elevation="0"
                  color="#FACD89"
                  block
                >
                  <v-icon class="mr-2"> mdi-close-thick</v-icon>
                  Cancelar
                </v-btn>
              </v-col>
            </v-row>
          </div>
        </v-card>
      </v-dialog>

      <v-col cols="12" xs="12" sm="12" md="12" lg="6">
        <v-toolbar
          color="#facd89"
          dark
          class="Montserrat-SemiBold text--darken-3 grey--text"
        >
          Expedientes seleccionados
        </v-toolbar>
        <v-card class="mx-auto" tile>
          <v-list>
            <div
              v-if="seleccionados.length === 0"
              class="contentSize Montserrat-Regular pa-4"
            >
              Aún no ha seleccionado ningún expediente para englosar
            </div>
            <v-list-item v-for="item in seleccionados" :key="item.id">
              <v-list-item-icon v-if="seleccionados[0] === item">
                <v-icon color="#FACD89">mdi-file</v-icon>
              </v-list-item-icon>
              <v-list-item-icon v-else>
                <v-icon>mdi-file</v-icon>
              </v-list-item-icon>
              <v-list-item-content>
                <v-list-item-title
                  class="contentSize Montserrat-SemiBold"
                  v-text="item.nro_expediente"
                ></v-list-item-title>
                <v-list-item-content
                  class="contentSize Montserrat-Regular"
                  v-text="item.extracto"
                />
                <v-row justify="start" class="my-1">
                  <v-btn @click="quitar(item)" class="justify-start">
                    <v-icon class="red--text">mdi-close</v-icon>
                    <div class="Montserrat-Regular text-start red--text">
                      Quitar Selección
                    </div>
                  </v-btn>
                </v-row>
                <v-divider class="my-2"></v-divider>
              </v-list-item-content>
            </v-list-item>
          </v-list>

          <v-row
            justify="center"
            align="center"
            v-if="!(seleccionados.length === 1)"
            class="contentSize Montserrat-Regular pa-6"
          >
            <v-btn
              @click="confirmarEnglose"
              :disabled="this.$store.getters.get_consul_loading"
              class="pa-1 color Montserrat-SemiBold px-6"
              height="50"
              elevation="0"
              color="#FACD89"
            >
              <v-icon class="px-2"> mdi-check-bold </v-icon>
              Confirmar
            </v-btn>
          </v-row>
        </v-card>
      </v-col>
    </v-row>

    <modal-exito-englose :show="get_show_englose" />
    <v-overlay :value="this.$store.getters.get_consul_loading">
      <v-progress-circular indeterminate size="60"></v-progress-circular>
    </v-overlay>
  </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import ModalExitoEnglose from "../../components/dialogs/ModalExitoEnglose";

export default {
  components: { ModalExitoEnglose },
  props: {
    headers: Array,
    data: Array,
    loading: { type: Boolean, default: false },
  },

  data() {
    return {
      seleccionados: [],
      search: "",
      show: false,
      btn: false,
      dialog: false,
      dialog_posicion_padre: false,
      exp_padre: false,
      confirmar: false,
      padre_aux: [],
      dialog_ya_hay_padre: false,
    };
  },

  computed: mapGetters(["get_consul_loading", "get_show_englose"]),

  watch: {
    dialog(val) {
      val &&
        setTimeout(() => {
          this.dialog = false;
        }, 2000);
    },
    dialog_ya_hay_padre(valu) {
      valu &&
        setTimeout(() => {
          this.dialog_ya_hay_padre = false;
        }, 2000);
    },
  },

  methods: {
    ...mapActions(["englosar"]),

    confirmarEnglose() {
      let expediente_hijo = [];

      for (var i = 1; i < this.seleccionados.length; i++) {
        expediente_hijo.push(this.seleccionados[i].expediente_id);
      }

      let expedientes_englose = {
        fojas_aux: this.seleccionados[0].fojas,
        exp_padre: this.seleccionados[0].expediente_id,
        exp_hijos: expediente_hijo,
      };
      this.englosar(expedientes_englose);
      this.show = true;
    },

    padre_asignar(item) {
      let bandera2 = this.seleccionados.filter((e) => e.hijos != null);

      if (bandera2.length === 0) {
        this.dialog_posicion_padre = true;
        this.padre_aux = item;
      } else {
        this.dialog_ya_hay_padre = true;
      }
    },

    padre() {
      this.seleccionados.splice(0, 0, this.padre_aux);
      this.dialog_posicion_padre = false;
    },

    seleccionar(item) {
      let bandera = this.seleccionados.filter(
        (e) => e.expediente_id === item.expediente_id
      );
      if (bandera.length === 0) {
        this.seleccionados.push(item);
      } else {
        this.dialog = true;
      }
    },

    quitar(item) {
      this.seleccionados.splice(this.seleccionados.indexOf(item), 1);
    },

    close() {
      this.dialog_posicion_padre = false;
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

.subSize {
  font-size: 22px;
}

.contentSize {
  font-size: 18px;
}
</style>
