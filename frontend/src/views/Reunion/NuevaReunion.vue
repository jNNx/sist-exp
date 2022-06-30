<template>
  <div>
    <titulo texto="Nueva Reunión" icono="mdi-account-group" />
    <v-row no-gutters class="mt-10" justify="center">
      <v-col cols="12" sm="6" lg="6" class="px-sm-2">
        <LabelInput texto="Fecha:"/>
        <InputDate/>
      </v-col>

      <v-col cols="12" sm="6" lg="6" class="px-sm-2">
        <LabelInput class="pl-lg-5" texto="Hora:"/>
        <TextField class="pl-lg-4"/>
      </v-col>
    </v-row>

    <v-row no-gutters justify="center">
      <v-col cols="12" sm="12" lg="12" class="px-sm-2">
        <LabelInput texto="Motivo:"/>
        <TextField hint="Escriba motivo de la reunión"/>
      </v-col>
    </v-row>

    <v-row no-gutters>
        <v-col cols="12" class="px-sm-2">
          <label-input texto="Enviar a:"/>
        </v-col>
        <v-col cols="12" sm="12" lg="6" class="px-sm-2">
          <div class="d-flex">
            <v-radio-group v-model="radioGroup" row>
              <v-radio
                  class="Montserrat-Regular text-justify" 
                  v-for="x in items"
                  :key="x"
                  :label="x"
                  color="warning"
              ></v-radio>
            </v-radio-group>
          </div>
        </v-col>
        <v-col cols="12" sm="12" lg="6" class="px-sm-2">
          <v-autocomplete
              class="Montserrat-Regular text-justify"
              color="amber accent-4"
              outlined
              item-value="id"
              item-text="descripcion"
              return-object
              single-line
              label="Seleccione las áreas a invitar"
            >
            </v-autocomplete>
        </v-col>
    </v-row>

    <v-row no-gutters justify="center" class="mt-2">
      <v-col cols="12" sm="6" md="6" lg="6" class="px-sm-2 py-8 pr-lg-6">
        <Button texto="Invitar" icono="mdi-account-plus"/>
      </v-col>
      <v-col cols="12" sm="6" md="6" lg="6" class="px-sm-2 py-8 pl-lg-6">
        <SecondaryButton texto="Cancelar" icono="mdi-close-thick"/>
      </v-col>
    </v-row>

  </div>
</template>
<script>
import Titulo from "../components/Titulo"
import LabelInput from "../components/LabelInput";
import TextField from "../components/TextField";
import SecondaryButton from "../components/SecondaryButton";
import Button from "../components/Button";
import InputDate from "../components/InputDate";

export default {
  name: 'Nueva reunion',
  components: {Titulo, LabelInput, TextField, InputDate, Button, SecondaryButton},
  data: () => ({
    radioGroup: 1,
    items: ['Todas las áreas', 'Seleccionar'],
  }),


}
</script>