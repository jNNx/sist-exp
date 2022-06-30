<template>
  <div>
    <v-hover v-slot="{ hover }" >
      <v-btn
        :class="hover ? 'orange accent-1' : 'grey lighten-2'"
        class="pa-8 Montserrat-Bold grey--text text--darken-3"
        :height="alto"
        :width="ancho"
        :href="link"
        :target="target"
      >
        <v-icon class="px-4" left large color="#393B44">
          {{ icono }}
        </v-icon>
        {{texto}}
      </v-btn>
    </v-hover>
  </div>
</template>
<script>
export default {
  name: 'BotonHorizontal',
  props: {
    icono: String,
    texto: String,
    alto: String,
    ancho: String,
    link: String,
    target: null,
  },
}
</script>
