<template>
  <div>
    <v-tooltip bottom>
      <template v-slot:activator="{ on, attrs }">
        <v-btn
            color="#393b44"
            class="elevation-0 py-8"
            file
            v-bind="attrs"
            v-on="on"
        >
          <v-badge
              :content="messages"
              :value="messages"
              color="#FACD89"
              overlap
              v-bind="attrs"
              v-on="on"
          >
            <v-icon color="grey lighten-4">
              mdi-message-text-outline
            </v-icon>
          </v-badge>
        </v-btn>
      </template>

      <div v-if="messages == 0">
        <span>No hay mensajes nuevos</span>
      </div>
      <div v-else>
        <span>{{messages}} mensajes nuevos</span>
      </div>

    </v-tooltip>
  </div>
</template>

<script>

export default {
  data: () => ({
    messages: 3,
  })
}
</script>