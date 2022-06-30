<template>
  <div align="center" justify="center">
    <v-img
        src="/img/tribunal-mobile.png"
        class=""
    />
    <div class="titulo Montserrat-Bold py-3">
      ¡BIENVENIDO/A!
    </div>

    <form @submit.prevent="onLogin" enctype="multipart/form-data">
      <v-flex class="pt-3 px-6"  align="center">
        <div class="size Montserrat-Bold text-justify pb-2 pt-4 black--text">
          <v-icon color="#000000">mdi-account</v-icon>
          CUIL:
        </div>
        <v-text-field
          :color="
                this.$store.getters.get_errores
                  ? 'red lighten-1'
                  : 'amber accent-4'
              "
              :background-color="
                this.$store.getters.get_errores ? 'red lighten-4' : 'white'
              "
              outlined
              v-model="credentials.cuil"
              name="user.cuil"
        ></v-text-field>
      </v-flex>
      <v-flex class="pb-3 px-6"  align="center">
        <div class="size Montserrat-Bold text-justify pb-2 black--text">
          <v-icon color="#000000">mdi-key-variant</v-icon>
          Contraseña:
        </div>
        <v-text-field
          :color="
            this.$store.getters.get_errores
              ? 'red lighten-1'
              : 'amber accent-4'
          "
          :background-color="
            this.$store.getters.get_errores ? 'red lighten-4' : 'white'
          "
          :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
          :type="show1 ? 'text' : 'password'"
          @click:append="show1 = !show1"
          outlined
          v-model="credentials.password"
          name="user.password"
        ></v-text-field>

        <v-alert
          v-if="this.$store.getters.get_error_logeo || this.$store.getters.get_error_Cuil || this.$store.getters.get_error_contra "
          outlined
          color="red"
          close-text="Close Alert"
        >
          <div
            class="Montserrat-Bold red--text fontError text-start py-2 pt-6"
          >
            <div class="pb-2">
              <v-icon color="red">mdi-exclamation-thick</v-icon>No pudimos loguearte
            </div>

            <label-error :texto="this.$store.getters.get_error_logeo" />
            <label-error :texto="this.$store.getters.get_error_Cuil" />
            <label-error :texto="this.$store.getters.get_error_contra" />
            
          </div>
        </v-alert>

        <v-btn
          :disabled="this.$store.getters.get_btn_login"
          type="submit"
          class="mt-6 pa-5 color Montserrat-SemiBold"
          height="55"
          elevation="0"
          color="#FACD89"
          block
        >
          <v-icon class="pr-5"> mdi-arrow-right-thin-circle-outline </v-icon>
          Ingresar
        </v-btn>
      </v-flex>
    </form>
    <v-overlay :value="this.$store.getters.get_btn_login">
      <v-progress-circular indeterminate size="60"></v-progress-circular>
    </v-overlay>
  </div>
</template>

<script>
import LabelError from "../LabelError";
import { mapActions, mapGetters } from "vuex";
export default {
  components: { LabelError },
  name: 'App',

  data() {
    return {
      show1: false,
      credentials: {
        cuil: null,
        password: null,
      },
    }
  },

  computed: {
    ...mapGetters([
      "get_error_logeo",
      "get_error_Cuil",
      "get_error_contra",
      "get_errores",
      "get_logueo",
    ]),
  },

  watch: {
    get_logueo(value) {
      if (value) this.$router.go(0);
    },
  },

  methods: {
    ...mapActions({
      login: "login",
      verificar: "verificar",
    }),

    onLogin() {
      (this.loading = true), this.login(this.credentials);
    },
  },

};
</script>
<style>
.size{
  font-size: 17px !important;
  color: #000000;
}

.titulo{
  font-size: 21px;
  color: #000000;
}
</style>