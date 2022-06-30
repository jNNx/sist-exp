import Vue from 'vue'
import App from './App.vue'
import router from './router'
import vuetify from './plugins/vuetify'
import store from './store'
import axios from "axios";

Vue.config.productionTip = false

Vue.use({
  install (Vue) {
    Vue.prototype.$api = axios.create({
      baseURL: process.env.VUE_APP_API_URL,
      withCredentials: true,
    })
  }
})

axios.defaults.headers.common.Authorization = `Bearer ${store.getters.get_token}`

new Vue({
  store,
  router,
  vuetify,
  render: h => h(App)
}).$mount('#app')
