import Vue from 'vue';
import Vuex from 'vuex';

import inventarios from "store/inventarios-store";
import ventas from "store/ventas-store";


Vue.use(Vuex);
export const store = new Vuex.Store({
    state: {},
    mutations: {},
    actions: {},
    modules: {
        inventarios: inventarios,
        ventas: ventas
    }
});