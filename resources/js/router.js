import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

import DashboardUtenteRegistrato from "./pages/DashboardUtenteRegistrato";
import Homepage from "./pages/Homepage";
import PaginaDettaglioAppartamentoPubblica from "./pages/PaginaDettaglioAppartamentoPubblica";
import PaginaDiRicercaAvanzata from "./pages/PaginaDiRicercaAvanzata";
import PaginaListaAppartamenti from "./pages/PaginaListaAppartamenti";
import PaginaListaMessaggiSingoloAppartamento from "./pages/PaginaListaMessaggiSingoloAppartamento";
import PaginaSponsorizzazione from "./pages/PaginaSponsorizzazione";
import PaginaStatisticheSingoloAppartamento from "./pages/PaginaStatisticheSingoloAppartamento";

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