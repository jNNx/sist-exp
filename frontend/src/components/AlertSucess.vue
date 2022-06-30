<template>
  <v-alert
      v-if="condicion"
      icon="mdi-check"
      dense
      prominent
      dismissible
      text
      type="success"
      class="alert Montserrat-SemiBold mt-5 sizeAlert"
      close-icon="mdi-close"
  >
    {{ texto }}
  </v-alert>
</template>

<script>
export default {
  props: {
    texto: String,
    condicion: Boolean,
  }
}
</script>

<style>
.sizeAlert{
  font-size: 16px !important;
}
</style>