<template>
    <v-dialog v-model="show" max-width="810px" content-class="round">
        <v-card class="px-7 pt-1">
            <titulo texto="Invitaciones enviadas" icono="mdi-check-all"/>

            <v-row no-gutters justify="center">
                <v-col cols="12" class="px-sm-2">
                    <div class="d-flex justify-end">
                        <p class="tex pt-5">Se enviaron con éxito las invitaciones a las áreas correspondientes.
                            Se les notificará a cada una.</p>
                    </div>
                </v-col>
            </v-row>

            <v-row no-gutters class="mt-6 pb-8">
                <v-col cols="12" lg="6" class="px-sm-2" justify-center>
                    <Button texto="Ver" icono="mdi-eye"/>
                </v-col>
                <v-col cols="12" lg="6" class="px-sm-2" justify-center>
                    <SecondaryButton texto="Cancelar" icono="mdi-close-thick"/>
                </v-col>
            </v-row>
        </v-card>
    </v-dialog>
</template>
<script>
import Titulo from "../Titulo"
import Button from "../Button";
import SecondaryButton from "../SecondaryButton";
export default {
  name: 'ModalInvitacionesEnviadas',
  components: {Titulo, Button, SecondaryButton},
  props: {
    show: Boolean,
  },
}
</script>
<style>
.round {
  border-radius: 30px;
}
</style>