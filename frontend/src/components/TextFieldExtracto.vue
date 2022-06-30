<template>
  <v-text-field  v-model="inputVal" :placeholder="placeholder" :prepend-inner-icon="icon" color="amber accent-4"/>
</template>

<script>
export default {
  props:{
    placeholder: String,
    icon: String,
    value: String,
  },
  data() {
    return {
      inputVal: this.value

    }
  },
  watch: {
    inputVal(val) {
      this.$emit('input', val);
    }
  }
}
</script>