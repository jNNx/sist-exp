<template>
  <div>
    <v-row class="my-2">
      <v-col cols="10">
        <h2 class="Montserrat-Bold text-justify">
          {{texto}} {{ nro }}
        </h2>
      </v-col>
      <v-col cols="2" class="iconoMobile" align="right">
        <v-icon color="#393B44" large>{{icono}}</v-icon>
      </v-col>
    </v-row>
    <v-divider color="#393B44" class="my-2"></v-divider>
  </div>
</template>

<script>
export default {
  name: 'Titulo',
  props: {
    texto: String,
    icono: String,
    nro: String
  }
}
</script>
<style>
h2{
  font-size: 30px;
  color: #393B44;
}
@media (max-width: 600px){
  .iconoMobile{
    display: none;
  }
}
</style>