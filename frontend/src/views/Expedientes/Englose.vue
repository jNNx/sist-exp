<template>
  <div>
    <titulo texto="Englose" icono="mdi-text-box-multiple"/>
    <div class="descripcion text-justify py-4">Recuerde que para acumular expedientes, el <strong>primero que seleccione será el principal.</strong></div>
    <englose :headers="headers" :data="get_expedientes"/>
  </div>
</template>

<script>
import Englose from "../../components/Tablas/TablaEnglose"
import Titulo from "../../components/Titulo";
import {mapActions, mapGetters} from "vuex";

export default {
  components:{Englose,Titulo},

  data() {
    return {
      headers: [
        {text: 'Nro. de Expediente', value: 'nro_expediente'},
        {text: 'Extracto', value: 'extracto'},
        {text: 'Seleccionar', value: 'action', align: 'center'},
      ],
    }
  },

  computed: mapGetters(['get_expedientes', 'get_finalizado']),

  mounted() {
    this.getExpe();

  },

  methods: {
    ...mapActions(['listadoExpedientes','cerrar']),

    getExpe(){
      let exp = {
        estado: 3,
        bandeja: 3,
      }
      this.listadoExpedientes(exp)
    },
  },

}
</script>