<template>
  <div>
    <h3 class="texto Montserrat-SemiBold mb-3 text-left">Buscar por:</h3>
    <v-row no-gutters>
      <v-col
          cols="12"
          sm="6"
          md="4"
          xl="3"
      >
        <v-autocomplete
            outlined
            :items="items"
            item-color="#8D93AB"
            class="mr-sm-3 mr-md-5"
            label="Seleccione un filtro"
            color="#8D93AB"
        />
      </v-col>
      <v-col
          cols="12"
          sm="6"
          md="4"
          xl="3"
      >
        <v-text-field
            color="#8D93AB"
            append-icon="mdi-magnify"
            label="Buscar"
            hide-details
            outlined
            class="ml-sm-3 ml-md-0 mr-md-5"
        />
      </v-col>
    </v-row>
  </div>
</template>
<script>
export default {
  name: 'Buscar',
  data: () => ({
    items: ['N° expediente', 'Tipo trámite', 'Área'],
  }),
}
</script>
<style>
.texto{
  font-size: 18px;
  color: #393B44;
}
</style>