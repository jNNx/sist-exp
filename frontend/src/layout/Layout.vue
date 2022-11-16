<template>
  <div>
      <div v-if="currentRoute === '/login'">
        <v-main>
          <router-view/>
        </v-main>
      </div>
      <div v-if="currentRoute !== '/login' ">
        <overlay :loading="get_btn_login"/>

        <NavbarMobile/>
        <Navbar/>
        <v-main class="mt-2 mb-8 mx-4 mx-sm-16">

          <div v-if="get_restart">
            <modal-recargar :show="true"/>
          </div>

          <div v-if="get_cantPendientes > 0">
            <alert-pendiente :cantidad="get_cantPendientes"/>
          </div>

          <router-view/>
        </v-main>
        <Footer/>

      </div>
  </div>
</template>

<script>
import Navbar from "../components/Navbar"
import Footer from "../components/Footer";
import NavbarMobile from "../components/NavbarMobile";
import AlertPendiente from  "../components/AlertPendiente"
import Overlay from "../components/Overlay";
import ModalRecargar from "../components/dialogs/ModalRecargar";

import {mapActions, mapGetters} from "vuex";

export default {
  components: { Footer, Navbar, NavbarMobile, AlertPendiente, Overlay, ModalRecargar},

  data: () => ({
    value: 'recent',
    currentRoute: window.location.pathname
  }),

  computed: mapGetters(['get_user','get_cantPendientes', 'getcantidad_subsidioAporteNR','get_btn_login','get_restart','get_subsidioAporteNR']),

  mounted() {
    this.getUsuario();
    this.exp_subsidioAporteNR();
    this.cantidadPendientes();
  },

  methods: {
    ...mapActions(['cantidadPendientes', 'exp_subsidioAporteNR', 'getUsuario']),
  }
}
</script>

<style>

.v-application {
  background-color: white !important;
}

@font-face {
  font-family: Montserrat-Regular;
  src: url('/fonts/Montserrat-Regular.otf');
}

@font-face {
  font-family: Montserrat-SemiBold;
  src: url('/fonts/Montserrat-SemiBold.otf');
}
@font-face {
  font-family: Montserrat-Bold;
  src: url('/fonts/Montserrat-Bold.otf');
}

.Montserrat-Regular{
  font-family: "Montserrat-Regular",serif;
}

.Montserrat-SemiBold {
  font-family: "Montserrat-SemiBold",serif;
}

.Montserrat-Bold {
  font-family: "Montserrat-Bold",serif;
}
</style>
