<template>
    <form @submit.prevent="cargaExtracto()" >
        <v-card color="#FACD89" outlined>
            <div class="pa-6">
                <div class="tex pb-2">OFICIO PRESENTADO POR:</div>
                <v-textarea
                    outlined
                    name="textarea"
                    color="amber accent-4"
                    auto-grow
                    v-model="input"
                ></v-textarea>
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
export default  {
    name: 'Oficio',
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
            const extracto = "OFICIO PRESENTADO POR:  " + this.input
            this.extracto(extracto)
        },

        ...mapActions([ 'extracto']),
    },
}
</script>
