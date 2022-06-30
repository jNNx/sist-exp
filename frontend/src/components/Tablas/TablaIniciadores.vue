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
      :headers="headers"
      :items="data"
      :search="search"
      :items-per-page="5"
      disable-sort
      mobile-breakpoint="300"
      class="elevation-1 mytable"
      loading-text="Cargando lista de iniciadores. Por favor, espere."
      :loading="loading"
        @page-count="pageCount = $event"
      no-data-text="No hay iniciadores cargados en el sistema"
    >
      <template v-slot:item.action="{ item }">
          <v-btn @click="enviarId(item)" fab small color="#FACD89" depressed>
            <v-icon>mdi-pencil</v-icon>
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
import {mapActions} from "vuex";
export default {
    components: {},
    props: {
    data: Array,
    loading: { type: Boolean, default: false },
    },

    data () {
        return {
          page: 1,
          pageCount: 0,
            search: "",
            headers: [
                { text: 'Nombre', value: 'nombre' },
                { text: 'CUIL', value: 'cuil' },
                { text: 'CUIT', value: 'cuit' },
                { text: 'Correo', value: 'email' },
                { text: 'Teléfono', value: 'telefono' },
                { text: 'Dirección', value: 'direccion' },
                {text: 'Editar', value: 'action', align: 'center', sortable: false},
            ],
        }
    },

    methods: {
      ...mapActions([ 'getIniciador']),

        enviarId(item) {
          let idiniciador = {
            id: item.id
          }

        this.getIniciador(idiniciador)
         // this.$router.push({ name: "EditarIniciador" });
        },
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
