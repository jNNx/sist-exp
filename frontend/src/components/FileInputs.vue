<template>
  <v-file-input
      class="Montserrat-Regular text-justify"
      v-model="inputVal"
      color="amber accent-4"
      counter
      multiple
      placeholder="Seleccione un archivo"
      prepend-icon="mdi-paperclip"
      outlined
      :show-size="1000"
  >
    <template v-slot:selection="{ index, text }">
      <v-chip
          v-if="index < 2"
          color="#facd89"
          dark
          label
          small
          class="black--text"
      >
        {{ text }}
      </v-chip>

      <span
          v-else-if="index === 2"
          class="text-overline grey--text text--darken-3 mx-2"
      >
        +{{ files.length - 2 }} Archivo(s)
      </span>
    </template>
  </v-file-input>
</template>


<script>
export default {
  props: ['value'],
  data() {
    return { inputVal: this.value , files: []}
  },
  watch: {
    inputVal(val) {
      this.$emit('input', val);
    }
  }

}
</script>