/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

 require('./bootstrap');

 window.Vue = require('vue').default;
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component('indicadores-home', require('./components/indicadoresHomeContainer.vue').default);
Vue.component('inventarios-list', require('./components/inventariosContainer.vue').default);
Vue.component('ventas-list', require('./components/ventasContainer.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
 import 'bootstrap-vue/dist/bootstrap-vue.css'
 
 import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
 Vue.use(BootstrapVue)
 Vue.use(IconsPlugin)

 Vue.component('clip-loader', require('vue-spinner/src/ClipLoader.vue').default);

 import VueSweetalert2 from 'vue-sweetalert2';
 import 'sweetalert2/dist/sweetalert2.min.css';
 Vue.use(VueSweetalert2);

 import Vuelidate from 'vuelidate';
 Vue.use(Vuelidate);

 import { store } from 'store/main-store';

 const app = new Vue({
    store,
    el: '#wrapper',
});
