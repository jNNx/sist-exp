<template>
    <v-hover v-slot="{ hover }" >
      <v-btn
          rounded
          width="170"
          height="170"
          :class="hover ? 'orange accent-1' : 'grey lighten-3'"
          class="mr-6 my-2 justify-center Montserrat-Bold grey--text text--darken-3"
          :href="link"
          :target="target"
      >
        <div class="d-flex flex-column center">
          <div>
            <v-icon size="90" class="py-2" :color="hover ? 'grey darken-1' : '#FDBC3F'"> {{icon}} </v-icon>
          </div>
          <div class="sizeBig pt-4">
            {{texto}}
          </div>
        </div>
      </v-btn>
    </v-hover>
</template>
<script>
export default {
  name: 'BotonHorizontal',
  props: {
    icon: String,
    texto: String,
    link: String,
    target: null,
  },
}
</script>

<style>
.center{
  text-align: center;
}

.sizeBig{
  font-size: 15px;
  text-align: center;
}
</style>