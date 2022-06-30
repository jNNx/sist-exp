<template>
  <v-menu width="10px" rounded offset-y>
    <template v-slot:activator="{ on }">
      <v-hover v-slot="{ hover }">
        <v-btn
          v-on="on"
          class="py-8"
          elevation="0"
          tile
          :color="hover ? '#393b44' : '#393b44'"
        >
          <v-icon :class="hover ? 'amber--text text--lighten-3' : 'white--text'"
            >mdi-account-circle</v-icon
          >
        </v-btn>
      </v-hover>
    </template>

    <v-card color="#393b44" class="py-3 ">
      <v-list-item>
        <v-list-item-content class="justify-center">
          <h6 class="px-2 Montserrat-Regular mx-auto text-end white--text">
            {{ get_user.area }}
          </h6>
          <h6 class="px-2 py-1 Montserrat-Regular mx-auto text-end white--text">
            {{ get_user.cuil }}
          </h6>
        </v-list-item-content>
      </v-list-item>

      <v-divider class="my-1"></v-divider>

      <div>
        <v-hover v-slot="{ hover }" class="d-flex justify-end py-2">
          <v-btn block depressed text href="/usuario">
            <h5
              class="px-2 Montserrat-Regular"
              :class="hover ? 'amber--text text--lighten-3' : 'white--text'"
            >
              Editar Perfil
            </h5>
            <v-icon
              :class="hover ? 'amber--text text--lighten-3' : 'white--text'"
              >mdi-account</v-icon
            >
          </v-btn>
        </v-hover>
        <v-divider class="my-1"></v-divider>
      </div>

      <div>
        <v-hover v-slot="{ hover }" class="d-flex justify-end py-2">
          <v-btn block large depressed text @click="onLogout()">
            <h5
              class="px-2 Montserrat-Regular"
              :class="hover ? 'amber--text text--lighten-3' : 'white--text'"
            >
              Salir
            </h5>
            <v-icon
              :class="hover ? 'amber--text text--lighten-3' : 'white--text'"
              >mdi-logout</v-icon
            >
          </v-btn>
        </v-hover>
      </div>
    </v-card>
  </v-menu>
</template>

<script>
import { mapActions, mapGetters } from "vuex";

export default {
  computed: mapGetters(["get_user"]),

  methods: {
    ...mapActions({
      salir: "logout",
    }),

    onLogout() {
      this.salir();
      this.$router.go(0);
    },
  },
};
</script>
