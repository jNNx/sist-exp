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
        :page.sync="page"
        hide-default-footer
        @page-count="pageCount = $event"
      :headers="headers"
      :items="data"
      :search="search"
      :items-per-page="5"
      sort-asc
      disable-sort
      mobile-breakpoint="300"
      class="elevation-1 mytable"
      v-model="selected"
      loading-text="Cargando expedientes. Por favor, espere."
      :loading="loading"
      no-data-text="No hay Expedientes Pendientes por aceptar"
    >
      <template v-slot:item.prioridad="{ item }">
        <v-chip :color="getColor(item.prioridad)">
          <v-icon size="20px" class="mr-1">{{
            getIcon(item.prioridad)
          }}</v-icon>
          <h5 class="font-weight-regular">{{ item.prioridad }}</h5>
        </v-chip>
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
    ...mapActions([""]),

    getColor(prioridades) {
      if (prioridades === "alta") return "red lighten-3";
      if (prioridades === "normal") return "grey lighten-2";
    },
    getIcon(prioridades) {
      if (prioridades === "alta") return "mdi-exclamation-thick";
      else return "mdi-check-bold";
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
