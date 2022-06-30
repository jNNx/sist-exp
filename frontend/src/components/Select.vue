<template>
  <v-select
      :items="items"
      class="Montserrat-SemiBold text-justify"
      height="60"
      color="amber accent-4"
      outlined
  ></v-select>
</template>

<script>
export default {
  name: 'Select',
  props: {
    items: Array,
  }
}
</script>

<style>
.v-select{
  font-size: 21px !important;
  color: #393B44;
}
</style>