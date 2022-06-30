<template>
    <div class="mb-16 pb-8">
        <form @submit.prevent="storeIniciador(inicia)" >
            <titulo texto="Nuevo Iniciador" icono="mdi-account-plus" class="pb-8"/>

          <v-row no-gutters>
            <v-col cols="12" sm="12" lg="6" class="pr-lg-2">
              <label-error :texto="this.get_error_nombre"/>
            </v-col>

            <v-col cols="12" sm="12" lg="6" class="pl-lg-2">
              <label-error :texto="this.get_error_tipo_entidad"/>
            </v-col>
          </v-row>

            <v-row no-gutters justify="center">
                <v-col cols="12" sm="12" lg="6" class="pr-lg-2">
                    <label-input texto="Nombre entidad / persona"/>
                    <text-field v-model="inicia.nombre"/>
                </v-col>

                <v-col cols="12" sm="12" lg="6" class="pl-lg-2">
                    <label-input texto="Tipo"/>
                    <autocomplete-field :data="allTipoEntidad" nombre="descripcion" v-model="inicia.tipo_entidad"/>
                </v-col>
            </v-row>


          <v-row no-gutters>
            <v-col cols="12" sm="12" lg="6" class="pr-lg-2">
              <label-error :texto="this.get_error_cuit"/>
            </v-col>

            <v-col cols="12" sm="12" lg="6" class="pl-lg-2">
              <label-error :texto="this.get_error_cuil"/>
            </v-col>
          </v-row>

            <v-row no-gutters justify="start">
                <v-col cols="12" sm="12" lg="6" class="pr-lg-2">

                  <label-input texto="CUIT"/>
                    <text-field tipo="number" v-model="inicia.cuit"/>
                </v-col>

                <v-col cols="12" sm="12" lg="6" class="pl-lg-2">

                    <label-input texto="CUIL"/>
                    <text-field tipo="number" v-model="inicia.cuil"/>
                </v-col>
            </v-row>


          <v-row no-gutters>
            <v-col cols="12" sm="12" lg="6" class="pr-lg-2">
              <label-error/>
            </v-col>

            <v-col cols="12" sm="12" lg="6" class="pl-lg-2">
              <label-error :texto="this.get_error_email"/>
            </v-col>
          </v-row>

            <v-row no-gutters justify="start">
                <v-col cols="12" sm="12" lg="6" class="pr-lg-2">
                    <label-input texto="Área de reparticiones"/>
                    <text-field v-model="inicia.area_reparticiones"/>
                </v-col>


                <v-col cols="12" sm="12" lg="6" class="pl-lg-2">

                    <label-input texto="Correo electrónico"/>
                    <text-field v-model="inicia.email"/>
                </v-col>
            </v-row>


          <v-row no-gutters>
            <v-col cols="12" sm="12" lg="6" class="pr-lg-2">
              <label-error :texto="this.get_error_telefono"/>
            </v-col>

            <v-col cols="12" sm="12" lg="6" class="pl-lg-2">
              <label-error :texto="this.get_error_direccion"/>
            </v-col>
          </v-row>

            <v-row no-gutters justify="start">

                <v-col cols="12" sm="12" lg="6" class="pr-lg-2">

                    <label-input texto="Teléfono"/>
                    <text-field tipo="number" v-model="inicia.telefono"/>
                </v-col>


                <v-col cols="12" sm="12" lg="6" class="pl-lg-2">

                    <label-input texto="Dirección"/>
                    <text-field v-model="inicia.direccion"/>
                </v-col>
            </v-row>

            <v-row no-gutters justify="center" class="my-4">
                <v-col cols="12" sm="6" md="6" lg="6" class="py-6 px-sm-2">
                    <SecondaryButton link="/" texto="Volver a inicio" icono="mdi-keyboard-backspace"/>
                </v-col>
                <v-col cols="12" sm="6" md="6" lg="6" class="py-6 px-sm-2">
                    <v-btn type="submit" @click="abrirModalExitoNuevoIniciador()" class="pa-5 color Montserrat-SemiBold" height="55" elevation="0" color="#FACD89" block>
                        <v-icon class="px-5">
                        mdi-check-bold
                        </v-icon>
                        Confirmar
                    </v-btn>
                    <modal-exito-nuevo-iniciador :show="get_iniciador_creado" @close="closeModalExitoNuevoIniciador"/>
                </v-col>
            </v-row>
        </form>
    </div>
</template>

<script>
import Titulo from "../../components/Titulo";
import LabelInput from "../../components/LabelInput";
import TextField from "../../components/TextField";
import AutocompleteField from "../../components/AutocompleteField";
import {mapActions, mapGetters} from "vuex";
import SecondaryButton from "../../components/SecondaryButton";
import ModalExitoNuevoIniciador from '../../components/dialogs/ModalExitoNuevoIniciador.vue'
import LabelError from "../../components/LabelError"

export default {
    name: 'NuevoIniciador',
    components: {Titulo, LabelInput, TextField, AutocompleteField, SecondaryButton, ModalExitoNuevoIniciador, LabelError},

    data: () => ({
            inicia: {
                nombre: '',
                tipo_entidad: '',
                cuit: '',
                cuil: '',
                area_reparticiones: '',
                email: '',
                telefono: '',
                direccion: '',
            },
            showModal: false,
    }),

    mounted() {
      this.createTipoEntidad();
    },

    methods: {
        ...mapActions([
            'storeIniciador', 'createTipoEntidad'
        ]),
        abrirModalExitoNuevoIniciador() {
            this.showModal=!this.showModal
        },
        closeModalExitoNuevoIniciador() {
            this.showModal = false;
        },
    },

    computed: {
        ... mapGetters([
            'allTipoEntidad',
            'get_iniciador_creado',
            'get_error_nombre',
            'get_error_tipo_entidad',
            'get_error_cuit',
            'get_error_cuil',
            'get_error_telefono',
            'get_error_email',
            'get_error_direccion',

        ])
    },
}
</script>