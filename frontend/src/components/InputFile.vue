<template>
    <v-file-input
        v-model="files"
        :color="color"
        :label="label"
        :prepend-icon="icono"
        counter
        multiple
        outlined
        :show-size="1000"
    >
        <template v-slot:selection="{ index, text }">
            <v-chip
                v-if="index < 2"
                :color="colorVchip"
                dark
                label
                small
            >
                {{ text }}
            </v-chip>

            <span
                v-else-if="index === 2"
                class="text-overline grey--text text--darken-3 mx-2"
            >
                +{{ files.length - 2 }} Archivo(s)
            </span>
        </template>
    </v-file-input>
</template>

<script>
  export default {
    name: 'InputFile',
    props: {
        color: String,
        label: String,
        icono: String,
        colorVchip: String,
    },
  }
</script>
