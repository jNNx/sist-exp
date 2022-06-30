<template>
  <div class="sizeI Montserrat-SemiBold  pb-2">
    {{ texto }}
  </div>
</template>

<script>
export default {
  name: 'LabelInput',
  props: {
    texto: String,
  }
}
</script>

<style>
  .sizeI{
    font-size: 22px !important;
    color: #393B44;
  }
</style>