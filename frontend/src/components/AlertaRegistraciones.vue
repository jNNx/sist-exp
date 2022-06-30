<template>
  <v-alert
      v-if="true"
      icon="mdi-information-variant"
      dense
      prominent
      dismissible
      text
      type="info"
      class="alert Montserrat-SemiBold mt-5 sizeAlert"
      close-icon="mdi-close"
  >
    {{ texto }} SUBSIDIO y/o E/CTAS.APORTES NO REINTEGRABLE GASTOS.
    <a href="/expedientes-subsidios"  ><strong class="mx-3" style="text-decoration: underline">Ver Expedientes</strong></a>
  </v-alert>
</template>

<script>
export default {
  props: {
    texto: Number,
    condicion: Boolean,
  }
}
</script>

<style>
.sizeAlert{
  font-size: 16px !important;
}
</style>