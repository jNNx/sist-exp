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
        disable-sort
        mobile-breakpoint="300"
        class="elevation-1 mytable"
        loading-text="Cargando expedientes enviados. Por favor, espere."
        :loading="loading"
        no-data-text="No tienes expedientes enviados"
    >
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
