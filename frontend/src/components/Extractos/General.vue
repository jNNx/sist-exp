<template>
  <form @submit.prevent="cargaExtracto()" >
    <v-card color="#FACD89" outlined>

      <div class="pa-6">
        <v-textarea
            placeholder="Complete el extracto ..... "
            outlined
            name="textarea"
            color="amber accent-4"
            auto-grow
            v-model="input"
        ></v-textarea>

        <v-row class="tex" justify="start">
          <v-col cols="12" sm="12" lg="6" class="px-5">
            <div class="d-flex column d-flex-sm row">
              <p class="pt-5">INICIADOR: {{ iniciador.nombre }}</p>
            </div>
          </v-col>

          <v-col cols="12" sm="12" lg="6">
            <div class="d-flex justify-end">
              <p class="pt-5">{{ motivo.descripcion }}</p>
            </div>
          </v-col>
        </v-row>

      </div>
      <v-divider/>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn
            color="rgb(255, 255, 255, 0.2)"
            @click="isEditing = !isEditing"
            :disabled="isEditing"
            class="my-3 mr-4"
        >
          <v-icon class="pr-2"> mdi-pencil </v-icon>
          Editar
        </v-btn>
        <v-btn
            :disabled="!isEditing"
            color="rgb(255, 255, 255, 0.2)"
            @click="cargaExtracto()"
            type="submit"
            elevation="3"
            class="my-3 mr-4"
        >
          <v-icon class="pr-2"> mdi-check-bold </v-icon>
          Cargar extracto
        </v-btn>
      </v-card-actions>
      <v-snackbar
          v-model="hasSaved"
          :timeout="2000"
          absolute
          left
          color="#FACD89"
          class="ml-4 mb-2"
      >
        El extracto se ha guardado
      </v-snackbar>
    </v-card>
  </form>
</template>
<script>
import {mapActions} from "vuex";

export default {
  name: 'Acordada32-01Espontanea',

  props: {
    iniciador: {
      value: "No ha seleccionado ningun Iniciador",
      type: Object
    },

    motivo: {
      value: "No ha seleccionado aún",
      type: Object
    }
  },

  data () {
    return {
      hasSaved: false,
      isEditing: true,
      input: '',
    }
  },

  methods: {
    cargaExtracto() {
      this.isEditing = !this.isEditing
      this.hasSaved = true
      const extracto = this.input + " " + this.motivo.descripcion + "   " + this.iniciador.nombre
      this.extracto(extracto)
    },

    ...mapActions([
      'extracto',
    ]),
  },

}
</script>