<template>
  <div class="Montserrat-SemiBold" >
    <v-app-bar class="pl-4" height="64" color="#393b44">
      <v-row justify="start">
        <a href="/"><LogoNavbar/></a>
      </v-row>
        <DropdownMenuPerfilMobile/>
    </v-app-bar>
  </div>
</template>

<script>
import LogoNavbar from "../components/LogoNavbar";
import DropdownMenuPerfilMobile from "./DropdownMenuPerfilMobile";

export default {
  components : {LogoNavbar, DropdownMenuPerfilMobile}
}

</script>