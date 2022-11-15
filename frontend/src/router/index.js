import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import Login from '../views/Login.vue'
import NuevoExpediente from '../views/Iniciadores/NuevoExpediente.vue'
import BandejaDeEntrada from '../views/Expedientes/Pendientes.vue'
import MisExpedientes from '../views/Expedientes/MisExpedientes.vue'
// import NuevaReunion from '../views/Reunion/NuevaReunion.vue'
import NuevoPase from '../views/Expedientes/NuevoPase.vue'
import VerSeguimientos from '../views/Expedientes/VerSeguimientos.vue'
import NuevoIniciador from '../views/Iniciadores/NuevoIniciador.vue'
import Iniciadores from '../views/Iniciadores/Iniciadores.vue'
import EditarIniciador from '../views/Iniciadores/EditarIniciador.vue'
import layout from '../layout/Layout'
import Expedientes from "../views/Expedientes/Expedientes";
import Enviados from "../views/Expedientes/Enviados";
import Usuario from "../views/Usuario/Usuario";
import store from "../store/index";
import Englose from "../views/Expedientes/Englose";
import Cedula from "../views/Cedula/Cedula";
import MisEnviados from "../views/Usuario/HistorialEnviados";
import Desglose from "../views/Expedientes/Desglose"
import MotivoSubsidio from "../views/Expedientes/MotivoSubsidio"

import auth from "../middleware/auth";
import guest from "../middleware/guest";
import mesa_entrada from "../middleware/mesa_entrada";
import middlewarePipeline from "./middlewarePipeline";
//import relatorias from "../middleware/relatorias";
//import vocalias from "../middleware/vocalias"
//import informatica from "../middleware/informatica"
import nuevo_iniciador from "../middleware/nuevo_iniciador"
import cedula from "../middleware/cedula"
import Area from "../views/Expedientes/Area"
import DarBaja from "@/views/Expedientes/DarBaja";

Vue.use(VueRouter)

const routes = [

  {
    path: '/',
    name: '',
    component: layout,
    children: [{
        path: '/',
        name: 'Home',
        component: Home,
        meta: {title: 'Inicio', middleware: [auth] }
      },
      {
        path: '/historial-enviados',
        name: 'MisEnviados',
        component: MisEnviados,
        meta: { title: 'Historial Enviados', middleware: [auth]}
      },
      {
        path: '/dar-baja-expedientes',
        name: 'DarBaja',
        component: DarBaja,
        meta: { title: 'Expedientes', middleware: [auth]}
      },
      {
        path: '/englose',
        name: 'Englose',
        component: Englose,
        meta: { title: 'Englose', middleware: [auth, mesa_entrada]}
      },
      {
        path: '/desglose',
        name: 'Desglose',
        component: Desglose,
        meta: { title: 'Desglose', middleware: [auth, mesa_entrada]}
      },
      {
        path: '/nuevo-expediente',
        name: 'Nuevo',
        component: NuevoExpediente,
        meta: { title: 'Nuevo Expediente', middleware: [auth, mesa_entrada]}
      },
      {
        path: '/all-expedientes',
        name: 'Expedientes',
        component: Expedientes,
        meta: { title: 'Expedientes' }
      },
      {
        path: '/expedientes-pendientes',
        name: 'Expedientes Pendientes',
        component: BandejaDeEntrada,
        meta: { title: 'Pendientes' , middleware: [auth] }
      },
      {
        path: '/mis-expedientes',
        name: 'MisExpedientes',
        component: MisExpedientes,
        meta: { title: 'Mis Expedientes' , middleware: [auth] }
      },
      {
        path: '/nuevo-pase',
        name: 'NuevoPase',
        component: NuevoPase,
        meta: { title: 'Nuevo Pase', middleware: [auth]  }
      },
      {
        path: '/ver-historiales',
        name: 'VerHistoriales',
        component: VerSeguimientos,
        meta: { title: 'Ver Historiales', middleware: [auth]  }
      },
      {
        path: '/nuevo-iniciador',
        name: 'NuevoIniciador',
        component: NuevoIniciador,
        meta: { title: 'Nuevo Iniciador', middleware: [auth, nuevo_iniciador] }
      },
      {
        path: '/iniciadores',
        name: 'Iniciadores',
        component: Iniciadores,
        meta: { title: 'Iniciadores', middleware: [auth, mesa_entrada] }
      },
      {
        path: '/editar-iniciador',
        name: 'EditarIniciador',
        component: EditarIniciador,
        meta: { title: 'Editar Iniciador', middleware: [auth, mesa_entrada] }
      },
      {
        path: '/recuperar',
        name: 'Recuperar',
        component: Enviados,
        meta: { title: 'Recuperar' , middleware: [auth] }
      },
      {
        path: '/usuario',
        name: 'Usuario',
        component: Usuario,
        meta: { title: 'Usuario', middleware: [auth]  }
      },
      {
        path: '/cedula',
        name: 'Cedula',
        component: Cedula,
        meta: { title: 'Cedula', middleware: [auth, cedula]}
      },
      {
        path: '/expedientes-subsidios',
        name: 'Expedientes Subsidios',
        component: MotivoSubsidio,
        meta: { title: 'Subsidios' , middleware: [auth] }
      },
      {
        path: '/expedientes-area',
        name: 'Expedientes de mi Área',
        component: Area,
        meta: { title: 'Expedientes de mi Área' , middleware: [auth] }
      },
    ]
  },
  {
    path: '/login',
    name: 'Login',
    component: Login,
    meta: { title: 'Ingresar',  middleware: [guest]  }
  },
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

router.beforeEach((to, from, next) => {
  document.title = to.meta.title;
  next();
});

router.beforeEach((to, from, next) => {
  const middleware = to.meta.middleware;
  const context = { to, from, next, store };

  if (!middleware) {
    return next();
  }

  middleware[0]({
    ...context,
    next: middlewarePipeline(context, middleware, 1),
  });
});

export default router
