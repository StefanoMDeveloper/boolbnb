import Vue from "vue";
import VueRouter from "vue-router";
    
Vue.use(VueRouter);

<<<<<<< HEAD
import DashboardUtenteRegistrato from "./pages/DashboardUtenteRegistrato.vue";
import Homepage from "./pages/Homepage.vue";
import PaginaDettaglioAppartamentoPubblica from "./pages/PaginaDettaglioAppartamentoPubblica.vue";
import PaginaDiRicercaAvanzata from "./pages/PaginaDiRicercaAvanzata.vue";
import PaginaListaAppartamenti from "./pages/PaginaListaAppartamenti.vue";
import PaginaListaMessaggiSingoloAppartamento from "./pages/PaginaListaMessaggiSingoloAppartamento.vue";
import PaginaSponsorizzazione from "./pages/PaginaSponsorizzazione.vue";
import PaginaStatisticheSingoloAppartamento from "./pages/PaginaStatisticheSingoloAppartamento.vue";
=======
import Homepage from "./pages/Homepage.vue";
import SingleApartment from "./pages/SingleApartment.vue";
import ApartmentsList from "./pages/ApartmentsList.vue";
import PageNotFound from "./pages/PageNotFound.vue";
>>>>>>> f0a4e00cf46c25183ec3227e8209b378515d5a1f

const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/",
            name: "Homepage",
            component: Homepage
        },
        {
            path: "/appartamenti/:slug",
            name: "SingleApartment",
            component: SingleApartment
        },
        {
            path: "/appartamenti",
            name: "ApartmentsList",
            component: ApartmentsList
        },
        {
            path: '#',
	        name: "page-404",
	        component: PageNotFound
        }
    ]
});

export default router