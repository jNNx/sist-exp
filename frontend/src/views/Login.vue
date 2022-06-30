<template>
    <div v-if="$vuetify.breakpoint.smAndDown">
        <login-celular/>
    </div>
    <div v-else>
        <login-escritorio/>
    </div>
</template>

<script>
import LoginCelular from "../components/Login/LoginCelular";
import LoginEscritorio from "../components/Login/LoginEscritorio";
export default {
  name: 'Login',
  components: { LoginCelular, LoginEscritorio},
}
</script>