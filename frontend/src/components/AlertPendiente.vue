<template>
  <v-alert
      icon="mdi-alert-circle"
      dense
      prominent
      text
      type="error"
      class="alert Montserrat-SemiBold mt-5 sizeAlert"
  >
    Tienes {{ cantidad }} expedientes pendientes para aceptar. <a href="/expedientes-pendientes" class="mx-2 error--text" > <strong class="error--text"> VER </strong> </a>
  </v-alert>
</template>

<script>
export default {
  props: {
    cantidad: Number,
  }
}
</script>

<style>
.sizeAlert{
  font-size: 16px !important;
}

</style>

