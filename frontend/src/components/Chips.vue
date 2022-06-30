<template>
    <v-chip
        class="ma-2"
        label
        :color="color"
        :text-color="colorTexto"
        >
            <div> {{ texto }} </div>
    </v-chip>
</template>

<script>
export default {
  props: {
    texto: String,
    colorTexto: String,
    color: String,
  }
}
</script>
