<template>
  <span v-if="$vuetify.breakpoint.xlOnly || $vuetify.breakpoint.lgOnly || $vuetify.breakpoint.smOnly">
    <img class="mt-4" height="70" width="200" :src="'./img/logo-white.svg'">
  </span>
  <span v-else-if="$vuetify.breakpoint.xsOnly">
    <img class="mt-4" height="70" width="170" :src="'./img/logo-white.svg'">
  </span>
  <span v-else>
    <img class="mt-4" height="60" width="90" :src="'./img/logo-sin-texto.svg'">
  </span>
</template>

<script>
</script>
