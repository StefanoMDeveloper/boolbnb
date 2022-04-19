import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

import DashboardUtenteRegistrato from "./pages/DashboardUtenteRegistrato.vue";
import Homepage from "./pages/Homepage.vue";
import PaginaDettaglioAppartamentoPubblica from "./pages/PaginaDettaglioAppartamentoPubblica.vue";
import PaginaDiRicercaAvanzata from "./pages/PaginaDiRicercaAvanzata.vue";
import PaginaListaAppartamenti from "./pages/PaginaListaAppartamenti.vue";
import PaginaListaMessaggiSingoloAppartamento from "./pages/PaginaListaMessaggiSingoloAppartamento.vue";
import PaginaSponsorizzazione from "./pages/PaginaSponsorizzazione.vue";
import PaginaStatisticheSingoloAppartamento from "./pages/PaginaStatisticheSingoloAppartamento.vue";

const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/DashboardUtenteRegistrato",
            name: "DashboardUtenteRegistrato",
            component: DashboardUtenteRegistrato
        },
        {
            path: "/",
            name: "Homepage",
            component: Homepage
        },
        {
            path: "/PaginaDettaglioAppartamentoPubblica",
            name: "PaginaDettaglioAppartamentoPubblica",
            component: PaginaDettaglioAppartamentoPubblica
        },
        {
            path: "/PaginaDiRicercaAvanzata",
            name: "PaginaDiRicercaAvanzata",
            component: PaginaDiRicercaAvanzata
        },
        {
            path: "/PaginaListaAppartamenti",
            name: "PaginaListaAppartamenti",
            component: PaginaListaAppartamenti
        },
        {
            path: "/PaginaListaMessaggiSingoloAppartamento",
            name: "PaginaListaMessaggiSingoloAppartamento",
            component: PaginaListaMessaggiSingoloAppartamento
        },
        {
            path: "/PaginaSponsorizzazione",
            name: "PaginaSponsorizzazione",
            component: PaginaSponsorizzazione
        },
        {
            path: "/PaginaStatisticheSingoloAppartamento",
            name: "PaginaStatisticheSingoloAppartamento",
            component: PaginaStatisticheSingoloAppartamento
        },
        {
            path: '*',
	        name: "page-404",
	        component: PageNotFound
        }
    ]
});

export default router