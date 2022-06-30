<template>
    <v-menu rounded="b-xl" offset-y>
      <template v-slot:activator="{ attrs, on }">
        <v-hover v-slot="{ hover }" >
          <v-btn
              v-ripple="false"
              color="transparent"
              elevation="0"
              file
              :class="hover ? 'amber--text text--lighten-3' : 'white--text'"
              class="px-9 Montserrat-SemiBold white--text"
              v-bind="attrs"
              v-on="on"
          >
            {{ titulo }} <v-icon class="pl-3">mdi-menu-down</v-icon>
          </v-btn>
        </v-hover>
      </template>

          <v-list color="#393b44">
              <v-list-item
                  v-for="item in dataItem"
                  :key="item.titulo"
                  :href="item.link"
                  class="px-8"
              >
                <v-hover v-slot="{ hover }" >
                  <v-list-item-title :class="hover ? 'amber--text text--lighten-3' : 'white--text'" class="Montserrat-Regular py-3">
                    {{ item.titulo}}
                  </v-list-item-title>
                </v-hover>
              </v-list-item>
          </v-list>
    </v-menu>
</template>

<script>
export default {
    props: {
      titulo: String,
      dataItem: Array,
    },

  data: () => ({
    items: [...Array(4)].map((_, i) => `Item ${i}`),
  }),
}
</script>

<style scoped>
.v-btn::before {
  background-color: transparent;
}
</style>
