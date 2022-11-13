<template>
  <div v-if="$vuetify.breakpoint.mdOnly || $vuetify.breakpoint.lgOnly || $vuetify.breakpoint.xlOnly" >
    <v-footer
        height="80"
        absolute
        color="#393B44">
      <v-row
          align="center"
          justify="center"
          class="ma-2"
      >
       <div class="px-9 Montserrat-SemiBold white--text">2022</div>
      </v-row>
    </v-footer>
  </div>
</template>

<script>
export default {
  name: "Footer"
}
</script>