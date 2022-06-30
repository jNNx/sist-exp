<template> 
    <div class="mb-16">
        <form @submit.prevent="guardarCambios()">
            <!-- VISTA NOTEBOOK-->
            <div v-if="$vuetify.breakpoint.lgAndUp">
                <v-row no-gutters justify="start" class="my-6">
                    <v-col cols="12" sm="12" lg="6" class="pb-6"> 
                        <h1 class="d-flex justify-start Montserrat-Bold pb-3 mt-6"> Editar Iniciador </h1> 
                        <v-divider color="#393B44" class="mt-2"></v-divider>
                        <v-row cols="6" no-gutters justify="start" class="pb-6">
                            <label-input class="pt-10" texto="Correo electrónico"/>
                            <v-col cols="12">
                                <label-error :texto="this.get_error_email"/>
                                <text-field v-model="inic.email" icon="mdi-email"/>
                            </v-col> 
                            <label-input texto="Teléfono"/>
                            <v-col cols="12">
                                <label-error :texto="this.get_error_telefono"/>
                                <text-field v-model="inic.telefono" icon="mdi-phone"/>
                            </v-col> 
                            <label-input texto="Dirección"/> 
                            <v-col cols="12">
                                <label-error :texto="this.get_error_direccion"/>
                                <text-field v-model="inic.direccion" icon="mdi-map-marker"/> 
                            </v-col> 

                            <v-col cols="12"> 
                                <v-btn type="submit" class="mt-8 pa-5 Montserrat-SemiBold" height="55" elevation="0" color="#FACD89" block> 
                                    <v-icon class="pr-5"> mdi-content-save </v-icon> 
                                    <div> Guardar </div> 
                                </v-btn> 
                                <modal-exito-editar-iniciador :close="closeModalExitoEditarIniciador" :show="get_show_modal_edit_iniciador"/>
                            </v-col> 
                        </v-row> 
                    </v-col>
                    <v-col cols="12" sm="12" lg="6" class="pl-lg-6 pb-16"> 
                        <h1 class="d-flex justify-start Montserrat-Bold pb-3 mt-6"> Iniciador </h1> 
                        <v-divider color="#393B44" class="mt-2"></v-divider> 
                        <v-row class="mt-8"> 
                            <v-col cols="12" sm="12" lg="12"> 
                                <v-card class="pa-6" color="#FACD89"> 
                                    <v-flex class="sizeTextBig Montserrat-SemiBold pt-2">Nombre:<span class="sizeTextSmall Montserrat-Regular"> {{iniciador.nombre}}</span> </v-flex>
                                <v-flex v-if="iniciador.cuil !== '-'" class="sizeTextSmall Montserrat-SemiBold pt-2">CUIL:<span class="sizeTextSmall Montserrat-Regular"> {{iniciador.cuil}} </span> </v-flex>
                                    <v-flex v-if="iniciador.cuit !== '-'" class="sizeTextSmall Montserrat-SemiBold pt-2">CUIT:<span class="sizeTextSmall Montserrat-Regular"> {{iniciador.cuit}} </span> </v-flex>
                                </v-card> 
                            </v-col> 
                        </v-row> 
                    </v-col>
                </v-row> 
            </div>

            <!-- VISTA DESKTOP Y MOBILE-->
            <div v-else>
                <v-row no-gutters justify="start" class="my-6">
                    <v-col cols="12" class="pl-lg-6 pb-16"> 
                        <h1 class="d-flex justify-start Montserrat-Bold pb-3 mt-6"> Iniciador </h1> 
                        <v-divider color="#393B44" class="mt-2"></v-divider> 
                        <v-row class="mt-8"> 
                            <v-col cols="12" sm="12" lg="12"> 
                                <v-card class="pa-6" color="#FACD89"> 
                                    <v-flex class="sizeTextBig Montserrat-SemiBold pt-2">Nombre:<span class="sizeTextSmall Montserrat-Regular"> {{iniciador.nombre}}</span> </v-flex>
                                <v-flex v-if="iniciador.cuil !== '-'" class="sizeTextSmall Montserrat-SemiBold pt-2">CUIL:<span class="sizeTextSmall Montserrat-Regular"> {{iniciador.cuil}} </span> </v-flex>
                                    <v-flex v-if="iniciador.cuit !== '-'" class="sizeTextSmall Montserrat-SemiBold pt-2">CUIT:<span class="sizeTextSmall Montserrat-Regular"> {{iniciador.cuit}} </span> </v-flex>
                                </v-card> 
                            </v-col> 
                        </v-row> 
                    </v-col>
                    <v-col cols="12" class="pb-6">
                        <h1 class="d-flex justify-start Montserrat-Bold pb-3 mt-6"> Editar Iniciador </h1> 
                        <v-divider color="#393B44" class="mt-2"></v-divider>
                        <v-row no-gutters justify="start" class="pb-6">
                            <label-input class="pt-10" texto="Correo electrónico"/> 
                            <v-col cols="12">
                                <label-error :texto="this.get_error_email"/>
                                <text-field v-model="inic.email" icon="mdi-email"/>
                            </v-col> 
                            <label-input texto="Teléfono"/>
                            <v-col cols="12">
                                <label-error :texto="this.get_error_telefono"/>
                                <text-field v-model="inic.telefono" icon="mdi-phone"/>
                            </v-col> 
                            <label-input texto="Dirección"/> 
                            <v-col cols="12">
                                <label-error :texto="this.get_error_direccion"/>
                                <text-field v-model="inic.direccion" icon="mdi-map-marker"/> 
                            </v-col> 

                            <v-col cols="12"> 
                                <v-btn type="submit" class="mt-8 pa-5 Montserrat-SemiBold" height="55" elevation="0" color="#FACD89" block> 
                                    <v-icon class="pr-5"> mdi-content-save </v-icon> 
                                    <div> Guardar </div> 
                                </v-btn>
                            </v-col>
                            <modal-exito-editar-iniciador :close="closeModalExitoEditarIniciador" :show="get_show_modal_edit_iniciador"/>
                        </v-row> 
                    </v-col>
                </v-row>
            </div>
        </form> 
    </div> 
</template> 
 
<script> 
import LabelInput from "../../components/LabelInput";
import {mapActions, mapGetters} from "vuex"; 
import TextField from "../../components/TextField";
import LabelError from "../../components/LabelError";
import ModalExitoEditarIniciador from '../../components/dialogs/ModalExitoEditarIniciador.vue'
 
export default { 
  name: 'EditarIniciador', 
  components: {LabelInput, TextField, LabelError, ModalExitoEditarIniciador}, 
    data() { 
        return {
          iniciadorA: '',
          showModal: false,
            inic: {
                email: this.$store.getters.iniciador.email ,
                telefono: this.$store.getters.iniciador.telefono,
                direccion: this.$store.getters.iniciador.direccion,
            },
          campoVacio: null,
        }
    },

    computed: mapGetters(['iniciador', 'get_show_modal_edit_iniciador', 'get_error_telefono', 'get_error_email', 'get_error_direccion',]),
 
    methods: { 
        ...mapActions([ 'updateIniciador', 'showModalEditIniciador']),

        guardarCambios (){
            if(this.inic.email == "-"){
                this.inic.email = this.campoVacio
            } 
            if(this.inic.telefono == "-"){
                this.inic.telefono = this.campoVacio
            } 
            if(this.inic.direccion == "-"){
                this.inic.direccion = this.campoVacio
            }

            let iniciadorUpdate ={
                id: this.iniciador.id,
                email: this.inic.email,
                telefono: this.inic.telefono,
                direccion: this.inic.direccion
            }

            this.updateIniciador(iniciadorUpdate)
        },

        closeModalExitoEditarIniciador() {
            this.showModalEditIniciador(false)
         },
    },
} 
</script>
 
<style> 
.sizeTextBig{ 
    font-size: 24px; 
    color: #393B44; 
} 
 
.sizeTextSmall{ 
    font-size: 22px; 
    color: #393B44; 
} 
</style>