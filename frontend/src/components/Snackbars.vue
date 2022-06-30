<template>
  <div>
    <v-snackbar
        class="Montserrat-SemiBold"
        color="#393b44"
        :value="get_estado_notificacion"
        :timeout="-1"
        absolute
        right
        shaped
        top
    >
      Ha ingresado un nuevo expediente con motivo de <strong>SUBSIDIO y/o E/CTAS.APORTES NO REINTEGRABLE GASTOS.</strong>

    <template v-slot:action="{ attrs }">
      <v-btn
          color="white"
          text
          v-bind="attrs"
          @click="exp_subsidioLeido()"
      >
        VER
      </v-btn>
    </template>
    </v-snackbar>
  </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex";

export default {

  computed: mapGetters(['get_estado_notificacion']),

  methods: {
    ...mapActions(['exp_subsidioLeido']),
  }
}
</script>