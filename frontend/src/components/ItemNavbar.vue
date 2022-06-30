<template>
  <div class="item">
    <v-menu
        transition="slide-y-transition"
        offset-y
        removed
    >
      <template v-slot:activator="{ attrs, on}">
        <v-hover v-slot="{ hover }" >
          <v-btn
              :href="link"
              plain
              tile
              elevation="0"
              v-bind="attrs"
              v-on="on"
              class="py-8"
              :class="hover ? 'black--text' : 'white--text' "
          >
            <h5>{{ texto }}</h5>
          </v-btn>
        </v-hover>
      </template>
    </v-menu>
  </div>
</template>

<script>
  export default {
    props: {
      texto: String,
      link: String
    },
  }
</script>
