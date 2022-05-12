require('./bootstrap');

import { createApp } from "vue"
import router from './router'
import UtenteIndex from './components/utente/UtenteIndex';

createApp({
    components: {
        UtenteIndex
    }
}).use(router).mount('#app')