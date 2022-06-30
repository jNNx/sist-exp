<template>
  <v-row justify="center">
    <v-card elevation="0" class="mt-6 mb-6 pa-5" width="1700" color="grey lighten-4">
      <div class="fontBig Montserrat-SemiBold">
        DETALLE DEL PASE
      </div>
      <v-divider class="mt-3"/>

      <v-row no-gutters>
        <v-col cols="12" xl="6" lg="6" md="12" sm="12" class="pt-5">
          <div class=" justify-start">
            <div class="fontSmall Montserrat-SemiBold mr-3"> Derivado a:</div>
            <div class="fontBig Montserrat-Regular"> {{ dataArea.descripcion }} </div>
          </div>
        </v-col>
        <v-col cols="12" xl="6" lg="6" md="12" sm="12" class="pt-5">
          <div class=" justify-start">
            <div class="fontSmall Montserrat-SemiBold mr-3"> Fecha y hora: </div>
            <div class="fontBig Montserrat-Regular"> {{ fecha[0]}}, {{ fecha[1] }}h. </div>
          </div>
        </v-col>
      </v-row>

      <v-row no-gutters>
        <v-col cols="12" xl="6" lg="6" md="12" sm="12" class="pt-5">
          <div class="justify-start">
            <div class="fontSmall Montserrat-SemiBold mr-3"> Agente que redacta el pase:</div>
            <div class="fontBig Montserrat-Regular"> {{ get_user.nombre_apellido }}</div>
          </div>
        </v-col>
        <v-col cols="12" xl="6" lg="6" md="12" sm="12" class="pt-5">
          <div class="d-flex">
            <div class="fontSmall Montserrat-SemiBold mr-3"> Fojas: </div>
            <div class="fontBig Montserrat-Regular"> {{ data.nro_fojas }} </div>
          </div>
        </v-col>
      </v-row>

      <v-row no-gutters class="py-5">
        <v-col cols="12" sm="12" lg="12">
            <div class="fontSmall Montserrat-SemiBold mr-3"> A efectos de: </div>
        </v-col>
        <v-col cols="12" sm="12" lg="12">
            <div class="fontBig Montserrat-Regular text-justify"> {{ data.observacion}} </div>
        </v-col>
      </v-row>
    </v-card>
  </v-row>

</template>
<script>
import {mapGetters} from "vuex";

export default {
  name: 'ModalIniciador',
   components: { },
    props: {
      show: Boolean,
      data: Object,
      dataArea: Object,
    },

  computed: {
    ... mapGetters(['areas','fecha','get_user'])
  },

}
</script>
<style>
.detalle{
    font-size: 25px;
    color: #FACD89;
}

.fontBig{
    font-size: 25px;
    color: #393B44;
}

.fontSmall{
    font-size: 24px;
    color: #393B44;
}
</style>