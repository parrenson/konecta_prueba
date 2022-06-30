
import { getField, updateField } from 'vuex-map-fields';

const state = {
    form: {
        id_producto: '',
        cantidad: 0
    }
};

const mutations = {
    updateField,
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
