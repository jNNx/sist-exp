<template>
    <form @submit.prevent="cargaExtracto()" >
        <v-card color="#FACD89">
            <div class="pt-8 px-8">
                <v-row class="tex" justify="start">
                    <v-col cols="12" sm="12" lg="6" class="px-5">
                        <div class="d-flex column d-flex-sm row">
                            <p class="pt-5 pr-3">E/REND.CTAS. N° </p>
                            <v-text-field
                                :disabled="!isEditing"
                                color="amber accent-4"
                                v-model="input1"
                            ></v-text-field>
                        </div>
                    </v-col>

                    <v-col cols="12" sm="12" lg="6" class="px-5">
                        <div class="d-flex column d-flex-sm row">
                            <p class="pt-5 pr-3">CANCELACIÓN.FDO.PTE.GTOS </p>
                            <v-text-field
                                :disabled="!isEditing"
                                color="amber accent-4"
                                v-model="input2"
                            ></v-text-field>
                        </div>
                    </v-col>

                    <v-col cols="12" sm="12" lg="6" class="px-5">
                        <div class="d-flex column d-flex-sm row">
                            <p class="pt-5 pr-3">DCTO </p>
                            <v-text-field
                                :disabled="!isEditing"
                                color="amber accent-4"
                                v-model="input3"
                            ></v-text-field>
                        </div>
                    </v-col>

                    <v-col cols="12" sm="12" lg="6" class="px-5">
                        <div class="d-flex column d-flex-sm row">
                            <p class="pt-5 pr-3">IMPORTE: $</p>
                            <v-text-field
                                :disabled="!isEditing"
                                color="amber accent-4"
                                v-model="input4"
                            ></v-text-field>
                        </div>
                    </v-col>
                </v-row>

                <v-row class="tex" justify="center">
                    <v-col cols="12" sm="6" lg="6" class="px-5">
                        <div class="d-flex column d-flex-sm row">
                            <p class="pt-5">INICIADOR: {{ iniciador.nombre }}</p>
                        </div>
                    </v-col>

                    <v-col cols="12" sm="6" lg="6">
                        <div class="d-flex justify-end">
                            <p class="pt-5">FONDO PERMANENTE CANCELACIÓN</p>
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
                class="ml-4 mb-2"
                color="#FACD89"
            >
                El extracto se ha guardado
            </v-snackbar>
        </v-card>
    </form>
</template>

<script>
import {mapActions} from "vuex";

export default {
    name: 'FondoPermanenteCancelacion',

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
        input1: '',
        input2: '',
        input3: '',
        input4: '',
      }
    },

    methods: {
        cargaExtracto() {
            this.isEditing = !this.isEditing
            this.hasSaved = true
            const extracto = "E/REND.CTAS. N° "+ this.input1 + ". CANCELACIÓN.FDO.PTE.GTOS " + this.input2 + ". DCTO " + this.input3 + ". IMPORTE: $" + this. input4 +  ". FONDO PERMANENTE CANCELACIÓN" + ". INICIADOR: " + this.iniciador.nombre
            this.extracto(extracto)
        },

        ...mapActions([
            'extracto',
        ]),
    },
}
</script>

<style>
.tex{
    font-family: Montserrat-Regular;
    font-size: 18px;
}
</style>
