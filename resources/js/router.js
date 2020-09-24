import Vue from "vue";
import VueRouter from "vue-router";

import NotFound from "./components/NotFound";
import FichaList from "./components/FichaList";
import FichaForm from "./components/FichaForm";
import Buscador from "./components/Buscador";

Vue.use(VueRouter);

const routes = [
    
    { path: "/fichas", name: 'fichas', component: FichaList, },

    { path: "/fichas/:id", name: 'ficha', component: FichaForm },

    { path: "/buscador", name: "buscador", component: Buscador },


    { path: '*', name: "NotFound", component: NotFound },
];

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes
})

export default router;