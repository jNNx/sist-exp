<template>
  <div>
    <titulo-inicio texto="Cédulas"/>
    <ButtonBig class="my-2" texto="Listado" link="/cedula" icon="mdi-card-account-details"/>
  </div>
</template>

<script>
import ButtonBig from "../ButtonBig";
import TituloInicio from "../TituloInicio";

export default {
  components: {ButtonBig, TituloInicio}
}
</script>