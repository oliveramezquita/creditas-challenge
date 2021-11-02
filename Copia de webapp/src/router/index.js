import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'

Vue.use(VueRouter)

const routes = [{
        path: '/',
        name: 'Home',
        component: Home
    },
    {
        path: '/registration/car',
        name: 'Registro de auto',
        component: () =>
            import ('../views/RegistrationCar.vue')
    },
    {
        path: '/registration/house',
        name: 'Registro de case',
        component: () =>
            import ('../views/RegistrationHouse.vue')
    },
    {
        path: '/registration/payroll',
        name: 'Registro de nómina',
        component: () =>
            import ('../views/RegistrationPayroll.vue')
    },
    {
        path: '/records/:type',
        name: 'Registros',
        component: () =>
            import ('../views/Records.vue')
    },
    {
        path: '/resume/:client_id',
        name: 'Resumen',
        component: () =>
            import ('../views/Resume.vue')
    }
]

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes
})

export default router