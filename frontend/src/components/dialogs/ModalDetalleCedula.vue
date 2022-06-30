<template>
    <v-dialog v-model="show" max-width="1200px" content-class="round" persistent justify="center">
        <v-card elevation="0" class="py-4 px-5" width="1700" color="grey lighten-4">
          <titulo texto="Cédulas asociadas" icono="mdi-card-account-details"/>

          <div v-if="!this.get_mensaje">
            <div v-if="$vuetify.breakpoint.mdAndUp">
              <v-row class="mt-2 pl-3 sizeTextSmall">
                <v-col cols="3" class="Montserrat-SemiBold text-justify orange--text accent-1">
                  NÚMERO
                </v-col>
                <v-col cols="6" class="Montserrat-SemiBold text-justify orange--text accent-1">
                  EMPLEADO
                </v-col>
              </v-row>
              <v-list color="grey lighten-4">
                <v-list-item
                  v-for="item in datos"
                  :key="item.id"
                >
                  <v-list-item-subtitle class="sizeTextSmall">
                    <v-row>
                      <v-col cols="3" class="Montserrat-Regular text-justify">
                        {{ item.nro_cedula }}
                      </v-col>
                      <v-col cols="6" class="Montserrat-Regular text-justify">
                        {{ item.user }}
                      </v-col>
                    </v-row>
                  </v-list-item-subtitle>
                </v-list-item>
              </v-list>
            </div>

            <div v-else
              v-for="item in datos"
              :key="item.id"
            >
              <div class="Montserrat-Regular sizeTextSmall text-justify py-2">N° {{ item.nro_cedula }} </div>
              <div class="Montserrat-Regular sizeTextSmall text-justify pb-2">Empleado: {{ item.user }}</div>
              <v-divider/>
            </div>
          </div>

          <div v-if="this.get_mensaje" class="Montserrat-Regular text-justify sizeCedula pt-2">
            Este expediente no tiene cédulas asociadas.
          </div>

          <v-row no-gutters justify="center" class="mt-8 mb-2">
            <v-col cols="12" sm="6" md="6" lg="6" class="px-sm-2">
              <v-btn
                @click="close"
                class="pa-5 color Montserrat-SemiBold"
                height="55"
                elevation="0"
                color="#FACD89"
                block
              >
                <v-icon class="pr-5"> mdi-close </v-icon>
                Cerrar
              </v-btn>
            </v-col>
          </v-row>
        </v-card>
    </v-dialog>
</template>

<script>
import {mapGetters} from "vuex";
import Titulo from "../../components/Titulo";
export default {
  name: 'ModalDetalleCedula',
  components: {Titulo},
  props: {
    show: { type: Boolean, default: false },
    datos: Array,
  },
  methods: {
    close() {
      this.$emit("close");
      this.$router.go(0);
    },
  },

  computed: {
      ... mapGetters(['get_mensaje'])
  },

}
</script>
<style>
@media (max-width: 600px) {
    .text-responsive {
        text-align: initial;
    }
}
@media (min-width: 600px) {
    .text-responsive {
        text-align: justify;
    }
}
</style>