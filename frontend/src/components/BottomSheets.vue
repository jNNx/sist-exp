<template>
  <div class="text-center Montserrat-SemiBold">
    <v-bottom-sheet v-model="sheet">
      <template v-slot:activator="{ on, attrs }">
        <v-btn
            value="recent"
            height="70"
            width="110"
            v-bind="attrs"
            v-on="on"
        >
          <h4 class="pt-2 white--text"> {{ titulo }}</h4>
          <v-icon class="white--text">{{ icono }}</v-icon>
        </v-btn>
      </template>

      <v-list color="#393b44">
        <v-subheader class="white--text">{{ titulo }}</v-subheader>
        <v-list-item
            v-for="list in listDesplegable"
            :key="list.titulo"
            :href="list.link"
            @click="sheet = false"
        >
          <v-icon class="pr-3 white--text">{{ list.icono }}</v-icon>
          <v-list-item-title class="Montserrat-SemiBold white--text" >{{ list.titulo }}</v-list-item-title>
        </v-list-item>
      </v-list>

    </v-bottom-sheet>
  </div>
</template>

<script>
export default {
  props: {
    titulo: String,
    icono:String,
    listDesplegable: Array,
  },

  data: () => ({
    sheet: false,
  }),
}
</script>