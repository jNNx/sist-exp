<template>
  <div v-if="$vuetify.breakpoint.mdOnly || $vuetify.breakpoint.lgOnly || $vuetify.breakpoint.xlOnly" >
    <div class="Montserrat-SemiBold" >
      <v-app-bar class="px-10" height="74" color="#393b44">
        <v-row no-gutters class="justify-space-around">
          
          <v-col cols="12" lg="2" md="1" align="start" align-self="center">
            <a href="/"><LogoNavbar/></a>
          </v-col>

          <v-col cols="12" lg="7" md="10" align="center" align-self="center">
            <div v-if="get_user.area === 'DPTO. MESA DE ENTRADAS Y SALIDAS' && get_user.cargo === 'Administrador Area'" >
              <DropdownMenu titulo="Bandejas" :data-item="bandejas"/>
              <DropdownMenu titulo="Expedientes" :data-item="expedientesMesaEntrada"/>
              <DropdownMenu titulo="Iniciadores" :data-item="iniciadores"/>
              
            </div>

            <div v-if="get_user.area === 'DPTO. MESA DE ENTRADAS Y SALIDAS' && get_user.cargo === 'Empleado'" >
              <DropdownMenu titulo="Bandejas" :data-item="bandejas"/>
              <DropdownMenu titulo="Expedientes" :data-item="expedientesMesaEntrada"/>
              <DropdownMenu titulo="Iniciadores" :data-item="iniciadoresInformatica"/>
              
            </div>

            <div v-if="(get_user.area === 'VOCALIA A') || (get_user.area === 'VOCALIA B') || (get_user.area === 'VOCALIA C') || (get_user.area === 'VOCALIA D') || (get_user.area === 'RELATORIA A') || (get_user.area === 'RELATORIA B') || (get_user.area === 'RELATORIA C') || (get_user.area === 'RELATORIA D')" cols="12" lg="6" align="center" align-self="center">
              <DropdownMenu titulo="Bandejas" :data-item="bandejas"/>
              <DropdownMenu titulo="Expedientes" :data-item="expedientesRelatoriasyVocalias"/>
            </div>

            <div v-if="get_user.area === 'DIRECCIÓN DE REGISTRACIONES'" cols="12" lg="6" align="center" align-self="center">
              <DropdownMenu titulo="Bandejas" :data-item="bandejas"/>
              <DropdownMenu titulo="Expedientes" :data-item="expedienteNotificaciones"/>
              <DropdownMenu titulo="Cédulas" :data-item="cedulas"/>
            </div>

            <div v-if="get_user.area === 'DIRECCIÓN DE INFORMATICA'" cols="12" lg="6" align="center" align-self="center">
              <DropdownMenu titulo="Bandejas" :data-item="bandejas"/>
              <DropdownMenu titulo="Expedientes" :data-item="expedientes"/>
              <DropdownMenu titulo="Iniciadores" :data-item="iniciadoresInformatica"/>
            </div>

            <div v-if="(get_user.area === 'SECRETARIA GENERAL TECNICA') || (get_user.area === 'SECRETARIA GENERAL ADMINISTRATIVA') || (get_user.area === 'ASESORIA LEGAL') || (get_user.area === 'DIRECCIÓN DE PERSONAL') || (get_user.area === 'DIRECCIÓN DE ADMINISTRACIÓN') || (get_user.area === 'DEPARTAMENTO FALLOS') || (get_user.area === 'ARCHIVO') || (get_user.area === 'AUDITORIA A') || (get_user.area === 'AUDITORIA B') || (get_user.area === 'AUDITORIA C') || (get_user.area === 'AUDITORIA D') || (get_user.area === 'PRESIDENCIA') || (get_user.area === 'MAESTRANZA')" cols="12" lg="6" align="center" align-self="center">
              <DropdownMenu titulo="Bandejas" :data-item="bandejas"/>
              <DropdownMenu titulo="Expedientes" :data-item="expedientes"/>
            </div>

            <div v-if=" (get_user.area === 'DPTO. NOTIFICACIONES')" cols="12" lg="6" align="center" align-self="center">
              <DropdownMenu titulo="Bandejas" :data-item="bandejas"/>
              <DropdownMenu titulo="Expedientes" :data-item="expedienteNotificaciones"/>
              <DropdownMenu titulo="Cédulas" :data-item="cedulas"/>
            </div>
          </v-col>

          <v-col cols="12" lg="2" md="1" align="end" align-self="center">
            <DropdownMenuPerfil />
          </v-col>
        </v-row>
      </v-app-bar>


    </div>
  </div>
</template>

<script>
import LogoNavbar from './LogoNavbar'
import DropdownMenu from "./DropdownMenu";
import DropdownMenuPerfil from "./DropdownMenuPerfil";
import {mapGetters} from "vuex";

export default {
  name: 'Navbar',

  components: {LogoNavbar,DropdownMenu,DropdownMenuPerfil},

  data: () => ({
    bandejas:[ {titulo:'Pendientes', link:'/expedientes-pendientes'},{titulo: 'Expedientes', link:'/expedientes'},{titulo: 'Enviados',link:'/historial-enviados'}, {titulo: 'Mi Área', link:"/expedientes-area"}],
    expedientes:[ {titulo: 'Pase', link:'/mis-expedientes'}, {titulo: 'Recuperar', link:'/recuperar'}],
    expedientesMesaEntrada:[ {titulo: 'Nuevo', link:'/nuevo-expediente'},{titulo: 'Pase', link:'/mis-expedientes'}, {titulo: 'Recuperar', link:'/recuperar'}, {titulo: 'Englose', link:'/englose'}, {titulo: 'Desglose', link:'/desglose'}],
    expedientesRelatoriasyVocalias:[ {titulo: 'Pase', link:'/mis-expedientes'}, {titulo: 'Recuperar', link:'/recuperar'}],
    iniciadores:[  {titulo: 'Nuevo', link:'/nuevo-iniciador'} , {titulo: 'Ver todos', link:'/iniciadores'}],
    iniciadoresInformatica:[ {titulo: 'Ver todos', link:'/iniciadores'}],
    expedienteNotificaciones:[{titulo: 'Pase', link:'/mis-expedientes'}, {titulo: 'Recuperar', link:'/recuperar'}],
    cedulas:[{titulo: 'Listado', link:'/cedula'}],
  }),

  computed: mapGetters(['get_user']),

};

</script>
