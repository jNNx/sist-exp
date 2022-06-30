<template>
  <div>
    <h3 class="Montserrat-Bold text-justify">
     {{ texto }}
    </h3>
  </div>
</template>

<script>
export default {
  name: 'TituloInicio',
  props: {
    texto: String
  }
}
</script>
<style>
  h3 {
    font-size: 25px !important;
    color: #393B44;
  }

  h5 {
    font-size: 10px;
    color: #393B44;
  }
</style>