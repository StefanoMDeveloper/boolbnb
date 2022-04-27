import Vue from "vue";
import VueRouter from "vue-router";
    
Vue.use(VueRouter);

import Homepage from "./pages/Homepage.vue";
import SingleApartment from "./pages/SingleApartment.vue";
import ApartmentList from "./pages/ApartmentList.vue";
import SearchResults from "./pages/SearchResults.vue";
import PageNotFound from "./pages/PageNotFound.vue";
import ChiSiamo2 from "./pages/ChiSiamo2.vue";

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
            name: "ApartmentList",
            component: ApartmentList
        },
        {
            path: "/risultati-ricerca",
            name: "SearchResults",
            component: SearchResults
        },
        {
            path: "/chi-siamo",
            name: "ChiSiamo2",
            component: ChiSiamo2
        },
        {
            path: '/*',
	        name: "page-404",
	        component: PageNotFound
        },

    ]
});

export default router