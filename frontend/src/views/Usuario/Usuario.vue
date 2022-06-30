<template>
    <div>
      <overlay :loading="get_btn_login"/>
        <v-row no-gutters justify="start" class="py-6">
            <v-col cols="12" sm="12" lg="6" class="pb-6">
                <h1 class="d-flex justify-start Montserrat-Bold pb-3 mt-6"> Cambiar contraseña </h1>
                <v-divider color="#393B44" class="mt-2"></v-divider>
                <alert-sucess texto="La contraseña se actualizó con éxito" :condicion="getNewPass" />

              <div v-if="!(getVerificarPass === true)" >
                <label-error :texto="getErrorPassOld"/>
                <label-error :texto="getErrorPassFail"/>
                <v-row cols="6" no-gutters justify="start" class="pb-6">
                  <label-input  class="pt-10" texto="Ingrese su contraseña actual"/>
                  <v-col cols="12">
                    <v-text-field
                        color="amber accent-4"
                        v-model="passwordOld"
                        :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
                        :type="show1 ? 'text' : 'password'"
                        @click:append="show1 = !show1"
                        background-color="white"
                        outlined
                    ></v-text-field>
                  </v-col>

                  <v-col cols="12">
                    <v-btn @click="verificarPassword"  class="pa-5 Montserrat-SemiBold" height="55" elevation="0" color="#FACD89" block>
                      <v-icon class="pr-5">  mdi-check-bold </v-icon>
                      <div> Aceptar </div>
                    </v-btn>
                  </v-col>
                </v-row>
              </div>

                <div v-if="getVerificarPass === true">
                  <label-error :texto="getErrorPassFail"/>
                    <v-row no-gutters justify="start" class="pb-2">
                        <v-col cols="12" class="pb-3">
                            <label-input class="mt-8" texto="Ingrese una nueva contraseña"/>
                            <alert type="error" texto="Las contraseñas no coinciden" :condicion="this.error2" />
                        </v-col>
                        <v-col cols="12">
                            <v-text-field
                                color="amber accent-4"
                                :append-icon="show2 ? 'mdi-eye' : 'mdi-eye-off'"
                                :type="show2 ? 'text' : 'password'"
                                @click:append="show2 = !show2"
                                background-color="white"
                                outlined
                                v-model="user.password"
                            ></v-text-field>
                        </v-col>
                    </v-row>

                    <label-input texto="Repita la nueva contraseña"/>
                    <v-row no-gutters justify="start" class="pb-16">
                        <v-col cols="12">
                            <v-text-field
                                color="amber accent-4"
                                :append-icon="show3 ? 'mdi-eye' : 'mdi-eye-off'"
                                :type="show3 ? 'text' : 'password'"
                                @click:append="show3 = !show3"
                                background-color="white"
                                outlined
                                v-model="repetirPass"
                            ></v-text-field>
                        </v-col>

                        <v-col cols="12">
                            <v-btn @click="nuevoPassword()" type="submit" class="pa-5 Montserrat-SemiBold" height="55" elevation="0" color="#FACD89" block>
                                <v-icon class="pr-5">  mdi-content-save </v-icon>
                                <div> Guardar </div>
                            </v-btn>
                        </v-col>

                    </v-row>
                </div>
            </v-col>

            <v-col cols="12" sm="12" lg="6" class="pl-lg-6 pb-16">
                <h1 class="d-flex justify-start Montserrat-Bold pb-3 mt-6"> Usuario </h1>
                <v-divider color="#393B44" class="mt-2"></v-divider>
                <v-row class="ma-5">
                    <v-col cols="12" sm="12" lg="4">
                        <v-img max-height="170" width="170" src='/img/usuario.png'></v-img>
                    </v-col>
                    <v-col cols="12" sm="12" lg="8">
                        <v-flex class="textHereBig Montserrat-SemiBold pb-2 text-uppercase">{{get_user.nombre_apellido}} </v-flex>
                        <v-flex class="textHereSmall Montserrat-SemiBold pt-2">ÁREA: <span class="Montserrat-Regular">{{get_user.area}}</span> </v-flex>
                        <v-flex class="textHereSmall Montserrat-SemiBold pt-2">CUIL: <span class="Montserrat-Regular">{{get_user.cuil}}</span> </v-flex>
                    </v-col>
                </v-row>
            </v-col>
        </v-row>
    </div>
</template>

<script>
import LabelInput from "../../components/LabelInput";
import AlertSucess from "../../components/AlertSucess"
import Alert from "../../components/Alert";
import LabelError from "../../components/LabelError";
import Overlay from "../../components/Overlay";

import {mapGetters, mapActions} from "vuex";

export default {
  name: 'Usuario',
  components: {LabelInput, AlertSucess, Alert, LabelError, Overlay},
    data() {
        return {
            user:{
                id: this.$store.getters.getIdUser,
                password: '',
            },
            passwordOld:'',
            passwordNew:'',
            repetirPass: '',

            show1: false,
            show2: false,
            show3: false,
            error1: false,
            error2: false,
            mostrar: false,
            mostrar2: false,
            SucessPass: false,
        }
    },

  computed: mapGetters(['get_user','get_btn_login','getErrorPassFail', 'getNewPass', 'cambiado', 'getVerificarPass','getErrorPassOld']),

  methods:{
    ...mapActions(['verificarPass', 'nuevaContrasena']),

    verificarPassword () {
      let user = {
        password: this.passwordOld,
      }
      this.verificarPass(user)
    },

  nuevoPassword() {
      if (this.user.password === this.repetirPass){
          this.error2 = false,
          this.nuevaContrasena(this.user)
      }
      else{
          this.error2 = true;
      }
  }
    },
  

}
</script>

<style>
.textHereBig{
    font-size: 26px;
    color: #393B44;
}

.textHereSmall{
    font-size: 18px;
    color: #393B44;
}
</style>