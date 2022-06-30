<template>
  <div>
    <v-row>
      <v-col lg="3" v-for="x in datos" :key="x.texto">
          <v-card class="mx-auto pa-2" color="#FACD89" height="220">
            <v-list-item three-line>
              <v-list-item-content>
                <v-list-item-title class="mb-1 Montserrat-Bold ">
                  <p>{{ x.titulo}}</p>
                  <v-divider/>
                </v-list-item-title>
                <v-list-item-subtitle class="Montserrat-SemiBold">
                  {{ x.descripcion}}
                </v-list-item-subtitle>
              </v-list-item-content>

              <v-list-item-avatar tile size="100" color="transparent">
                <img :src="x.imagen">
              </v-list-item-avatar>
            </v-list-item>

            <v-card-actions>
              <v-btn class="Montserrat-SemiBold" block :to="x.link" outlined text>
                {{ x.botonText}}
              </v-btn>
            </v-card-actions>
          </v-card>

      </v-col>
    </v-row>
  </div>
</template>
<script>
export default {
  name: 'BotonHorizontal',
  props:{
    datos: Array,
  },
}
</script>