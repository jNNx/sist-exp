<template>
  <div>
    <v-row>
      <v-col cols="12" sm="4">
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

    <v-data-table
        @page-count="pageCount = $event"
        :page.sync="page"
        hide-default-footer
      :headers="headers"
      :items="data"
      :search="search"
      :items-per-page="5"
      disable-sort
      mobile-breakpoint="300"
      class="elevation-1 mytable"
      loading-text="Cargando expedientes enviados. Por favor, espere."
      :loading="loading"
      no-data-text="No tienes expedientes enviados"
    >
      <template v-slot:item.prioridad="{ item }">
        <v-chip :color="getColor(item.prioridad)">
          <v-icon size="20px" class="mr-1">{{
            getIcon(item.prioridad)
          }}</v-icon>
          <h5 class="font-weight-regular">{{ item.prioridad }}</h5>
        </v-chip>
      </template>

      <template v-slot:item.action="{ item }">
        <v-btn @click="recuperacion(item)" fab small color="#FACD89" depressed>
          <v-icon> mdi-arrow-u-left-bottom-bold </v-icon>
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

  </div>
</template>

<script>
import { mapActions } from "vuex";

export default {
  props: {
    headers: Array,
    data: Array,
    loading: { type: Boolean, default: false },
  },

  data() {
    return {
      page: 1,
      pageCount: 0,
      selected: [],
      search: "",
    };
  },

  methods: {
    getColor(prioridades) {
      if (prioridades === "alta") return "red lighten-3";
      if (prioridades === "normal") return "grey lighten-2";
    },
    getIcon(prioridades) {
      if (prioridades === "alta") return "mdi-exclamation-thick";
      else return "mdi-check-bold";
    },

    ...mapActions([
      "cambiarEstado"
      ]),

    recuperacion: function(item) {
      item.estado_expediente = 5 //cambia el estado del expediente
      item.estado = 1, //tabla
      item.bandeja= 4, //tabla
      this.cambiarEstado(item);
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
