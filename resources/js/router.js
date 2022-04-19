import Vue from "vue";
import VueRouter from "vue-router";
    
Vue.use(VueRouter);

import Homepage from "./pages/Homepage.vue";
import SingleApartment from "./pages/SingleApartment.vue";
import ApartmentsList from "./pages/ApartmentsList.vue";
import PageNotFound from "./pages/PageNotFound.vue";

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