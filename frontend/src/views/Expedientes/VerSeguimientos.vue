<template>
    <div class="mb-16 pb-10">
      <titulo class="pb-3" texto="Historial del Expediente N°" :nro="this.get_historial[0].nro_expediente" icono="mdi-text-box-search-outline"/>
      <!--
      <v-row>
        <v-btn @click="refColores=!refColores" color="grey lighten-2" class="mt-4 ml-3"> Referencia de colores
          <v-icon right>
            mdi-chevron-right
          </v-icon>
        </v-btn>

        <div class="text-center mt-3 pl-3" v-show="refColores">
          <v-chip
            class="ma-2"
            color="blue-grey darken-1"
            label
            text-color="white"
          >
            Departamento de Administración
          </v-chip>
        </div>
      </v-row>-->

        <v-timeline
            reverse
            align-top
            :dense="$vuetify.breakpoint.mdAndDown"
        >
            <v-timeline-item
              v-for="item in get_historial"
              :key="item.id"
              color="amber darken-4"
              :icon="item.icon"
              :area="item.area"
              :asignado="item.asignado"
              :fecha="item.fecha"
              fill-dot
            >
              <v-card
                  :color="item.color"
              >
                <v-card color="amber lighten-4">
                  <div class="pl-4 pt-4 pb-3">
                    <div class="area pb-2"> {{item.area}} </div>
                    <v-row class="titulo black--text">
                      <v-col cols="12" lg="8" md="12">
                        <div class="pt-2">Asignado a: {{item.nombre_usuario}}</div>
                      </v-col>
                      <v-col cols="12" lg="4" md="12">
                        <div class="pt-2">Fecha: {{item.fecha}} </div>
                      </v-col>
                    </v-row>
                  </div>
                </v-card>


                <v-card-text class="white text--primary">
                  <div class="Montserrat-Bold pb-2"> Área Origen: </div>
                  <p>{{item.area_origen}}</p>
                  <div class="Montserrat-Bold pb-2"> Derivado al Área: </div>
                  <p>{{item.area_destino}}</p>
                  <div class="Montserrat-Bold pb-2"> Motivo: </div>
                  <p>{{item.motivo}}</p>
                  <div class="Montserrat-Bold pb-2"> Hora: </div>
                  <p>{{item.hora}}</p>
                </v-card-text>

              </v-card>
            </v-timeline-item>
        </v-timeline>
    </div>
</template>
<script>
import Titulo from "../../components/Titulo"
import {mapActions, mapGetters} from "vuex";

export default {
  name: 'VerSeguimientos',
  components: {Titulo},


  data () {
    return {
      refColores: false,
    }
    },

  computed: mapGetters(['get_historial','get_historial_nro']),

  methods: {
    ...mapActions(['cerrar','historial_expediente']),
  }

  }
</script>

<style>
.titulo {
  font-family: Montserrat-Bold;
  font-size: 18px;
}

.area {
  font-family: Montserrat-Regular;
  font-size: 16px;
}
</style>