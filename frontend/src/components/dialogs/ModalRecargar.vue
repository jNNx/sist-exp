<template>
      <v-dialog rounded v-model="show" transition="dialog-bottom-transition" width="auto">
        <v-card>

          <v-toolbar color="red" height="250" dark>
            <v-row justify="center">
              <img class="mt-4 pa-4" width="240" height="240" :src="'./img/warning-sign.png'" />
            </v-row>
              <v-row justify="center">
                <h1>Oops! Ocurrió un error</h1>
              </v-row>
          </v-toolbar>

          <v-card-text class="pa-11">
              <v-row align="center">
                <h2 class="mr-2">Intenta refrescar la página, a veces funciona</h2>
                <v-icon large color="black">mdi-emoticon-outline</v-icon>
              </v-row>
          </v-card-text>

          <v-card-actions class="justify-center pb-8">
            <v-btn color="red" x-large class="pa-4 white--text" @click="recargar">
              Refrescar
              <v-icon>mdi-refresh</v-icon>
            </v-btn>
          </v-card-actions>

        </v-card>
      </v-dialog>
</template>

<script>

export default {
  props: {
    show: {type: Boolean, default: false}
  },

  methods:{
    recargar(){
      this.$router.go(0)
    }
  }
}
</script>