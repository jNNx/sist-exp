<template>
  <v-overlay :value="loading">
    <v-progress-circular
        indeterminate
        size="64"
    ></v-progress-circular>
  </v-overlay>
</template>

<script>
export default {
  props: {
    loading: Boolean,
  }
}
</script>