import { createRouter, createWebHistory } from "vue-router";

import UtenteIndex from '../components/utente/UtenteIndex'

const routes = [
    {
        path: '/home',
        name: 'index',
        component: UtenteIndex
    }
]

export default createRouter({
    history: createWebHistory(),
    routes
})
