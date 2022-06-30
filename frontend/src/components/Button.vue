<template>
    <v-btn  :outlined="sombras" :href="link" class="pa-5 color Montserrat-SemiBold" height="55" elevation="0" color="#FACD89" block>
      <v-icon class="pr-5">
        {{ icono }}
      </v-icon>
          <div class="">
            {{ texto }}
          </div>
    </v-btn>
</template>

<script>
export default {
  props: {
    sombras: {
      type: Boolean,
      default: false
    },
    texto: String,
    icono: String,
    link: String
  }
}
</script>
