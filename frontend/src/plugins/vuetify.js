import Vue from 'vue';
import Vuetify from 'vuetify/lib/framework';
import es from 'vuetify/src/locale/es.ts';

Vue.use(Vuetify);

export default new Vuetify({
    lang: {
        locales: { es },
        current: 'es',
    },
});
