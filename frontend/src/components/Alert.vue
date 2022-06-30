<template>
  <div>
    <v-alert
        v-if="condicion"
        icon="mdi-information-outline"
        dense
        prominent
        dismissible
        text
        :type="type"
        class="alert Montserrat-Regular"
        close-icon="mdi-close"

    >
      {{ texto }}
    </v-alert>
  </div>
</template>
<script>
export default {
  name: 'Alert',
  props:{
    texto: String,
    type: String,
    condicion: {type: Boolean, default: false},
  }
}
</script>
<style>
.alert{
  font-size: 17px;
}
</style>