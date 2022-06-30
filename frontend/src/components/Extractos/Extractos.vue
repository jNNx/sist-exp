<template>
  <div class="my-2">
    <div v-if="tipo == 0" >
      <extracto-loading/>
    </div>
    <div v-if="tipo==1">
      <fondo-permanente :iniciador="iniciador" :motivo="motivo"/>
    </div>
    <div v-if="tipo==2">
      <fondo-permantente-cancelacion :iniciador="iniciador" :motivo="motivo"/>
    </div>
    <div v-if="tipo==3">
      <subsidio :iniciador="iniciador" :motivo="motivo"/>
    </div>
    <div  v-if="tipo==4">
      <aporte-no-reintegrable :iniciador="iniciador" :motivo="motivo"/>
    </div>
    <!-- ID 5 - Balances -->
    <!-- ID 6 - Memorias -->
    <div v-if="tipo===7" >
      <!-- Acordada N° 32/2001 Espontánea -->
      <acordada3201 :iniciador="iniciador" :motivo="motivo"/>
    </div>
    <div v-if="tipo==8 || tipo==10 || tipo==13 || tipo==15 || tipo==20">
      <acordadas-en-general :iniciador="iniciador" :motivo="motivo"/>
    </div>
    <div v-if="tipo == 9" >
      <acordada-08-05 :iniciador="iniciador" :motivo="motivo"/>
    </div>
    <div v-if="tipo == 11" >
      <notas />
    </div>
    <!-- ID 12 - Cuenta de inversión -->
    <!-- ID 14 - Arancelamiento -->
    <!-- ID 16 - Fondo federal solidario -->
    <div v-if="tipo == 17" >
      <requerimiento :iniciador="iniciador" :motivo="motivo"/>
    </div>
    <div v-if="tipo == 18" >
      <oficio :iniciador="iniciador" :motivo="motivo"/>
    </div>
    <!-- ID 19 - FO.E.SE -->
    <div v-if="tipo==21" >
      <cedula-acordada-32-01 :iniciador="iniciador" :motivo="motivo"/>
    </div>
    <!-- ID 22 - Sueldos -->
    <!-- ID 23 - Cédula de Registraciones -->
    <div v-if="tipo==24" >
      <cedula-cambio-responsable :iniciador="iniciador" :motivo="motivo"/>
    </div>
    <div v-if="tipo==25" >
      <extracto-general :iniciador="iniciador" :motivo="motivo"/>
    </div>
    <div v-if="tipo==26" >
      <acordadas-en-general :iniciador="iniciador" :motivo="motivo"/>
    </div>
    <div v-if="(tipo===5) || (tipo===6) || (tipo===12) || (tipo===14) || (tipo===16) || (tipo===19) || (tipo===22) || (tipo===23)" >
     <general :iniciador="iniciador" :motivo="motivo"/>
    </div>

  </div>
</template>

<script>
import ExtractoLoading  from "./ExtractoLoading"
import FondoPermanente from "./FondoPermanente";
import FondoPermantenteCancelacion from "./FondoPermanenteCancelacion";
import Subsidio from "./Subsidio";
import AporteNoReintegrable from "./AporteNoReintegrable.vue";
import Acordada3201 from './Acordada-32-01.vue';
import AcordadasEnGeneral from "./AcordadasEnGeneral.vue";
import Acordada0805 from './Acordada-08-05.vue';
import Notas from './Notas.vue';
import Requerimiento from './Requerimiento.vue';
import Oficio from './Oficio.vue';
import CedulaAcordada3201 from "./CedulaAcordada32-01";
import CedulaCambioResponsable from "./CedulaCambioResponsable";
import ExtractoGeneral from "./ExtractoGeneral";
import General from "./General";
import {mapGetters} from "vuex";

export default {
  name: 'Extractos',
  props: {
    tipo: Number
  },
  components: {
    ExtractoLoading,
    FondoPermanente,
    FondoPermantenteCancelacion,
    Subsidio,
    AporteNoReintegrable,
    Acordada3201,
    AcordadasEnGeneral,
    Acordada0805,
    Notas,
    Requerimiento,
    Oficio,
    CedulaAcordada3201,
    CedulaCambioResponsable,
    ExtractoGeneral,
    General
  },

  computed: {
    ... mapGetters(['get_iniciadorSelected','allIniciadores','get_motivo_selected','motivoSinExtracto']),

    iniciador: function () {
      return  this.allIniciadores.find( item => item.id === this.get_iniciadorSelected)
    },

    motivo: function () {
      return  this.motivoSinExtracto.find( item => item.id === this.get_motivo_selected)
    },
  },
}
</script>