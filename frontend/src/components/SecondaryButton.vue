<template>
      <v-btn :href="link" block class="pa-5 color Montserrat-SemiBold" height="55" elevation="0" color="grey lighten-2">
        <v-icon left large>
          {{ icono }}
        </v-icon>
        <p class="Montserrat-Bold my-6 ml-7">{{ texto }}</p>
      </v-btn>
</template>

<script>
export default {
  name: 'SecondaryButton',
  props: {
    texto: String,
    icono: String,
    link: String,
  },
}
</script>