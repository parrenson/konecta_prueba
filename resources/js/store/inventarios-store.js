
import { getField, updateField } from 'vuex-map-fields';

const state = {
    form: {
        id: '',
        producto: '',
        referencia: '',
        precio: 0,
        peso: 0,
        categoria: '',
        stock: 0
    },
    inventario: []
};

const mutations = {
    updateField,
    updateInventario: (state, payload) => {
        state.inventario = payload;
    },
    updateItem: (state, payload) => {
        state.form.id = payload.id;
        state.form.producto = payload.producto;
        state.form.referencia = payload.referencia;
        state.form.precio = payload.precio;
        state.form.peso = payload.peso;
        state.form.categoria = payload.categoria;
        state.form.stock = payload.stock;
    },
};

const getters = {
    getField
};
export default {
    namespaced: true,
    state,
    mutations,
    getters
}
