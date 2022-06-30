<template>
  <v-autocomplete
      :label="label"
      class="Montserrat-Regular text-justify"
      color="amber accent-4"
      outlined
      :items="data"
      item-value="id"
      :item-text="nombre"
      v-model="inputVal"
      single-line
      item-color="amber accent-4"
  >
  </v-autocomplete>
</template>

<script>
export default {
  props: {
    data: Array,
    nombre: String,
    label: String
  },
  data() {
    return { inputVal: this.value }
  },
  watch: {
    inputVal(val) {
      this.$emit('input', val);
    }
  }
}
</script>