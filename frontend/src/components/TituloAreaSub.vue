<template>
  <div>
    <div class="Montserrat-Bold text-justify sizeArea">
      Área: {{area}}
    </div>
  </div>
</template>

<script>
export default {
  name: 'TituloInicio',
  props: {
    area: String,
  }
}
</script>
<style>
.sizeArea{
  font-size: 22px;
  color: #FB8C00;
}

h5 {
  font-size: 10px;
  color: #393B44;
}
</style>