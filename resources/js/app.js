/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


 


require('./bootstrap');

window.Vue = require('vue').default;


import Vue from 'vue'




import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'


// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)

// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)

import VueApexCharts from 'vue-apexcharts'
Vue.use(VueApexCharts)
Vue.component('apexchart', VueApexCharts)

import 'vue-select/dist/vue-select.css';

import VueSweetalert2 from 'vue-sweetalert2';

// If you don't need the styles, do not connect
import 'sweetalert2/dist/sweetalert2.min.css';

Vue.use(VueSweetalert2);



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
Vue.component('clientes', require('./components/clientes/Clientes.vue').default);
Vue.component('modal-nuevo-cliente', require('./components/clientes/ModalNuevoCliente.vue').default);
Vue.component('modal-edit-cliente', require('./components/clientes/ModalEditCliente.vue').default);


Vue.component('proveedores', require('./components/proveedores/Proveedores.vue').default);
Vue.component('modal-nuevo-proveedor', require('./components/proveedores/ModalNuevoProveedor.vue').default);
Vue.component('modal-edit-proveedor', require('./components/proveedores/ModalEditProveedor.vue').default);


Vue.component('productos', require('./components/productos/Productos.vue').default);
Vue.component('modal-nuevo-producto', require('./components/productos/ModalNuevoProducto.vue').default);
Vue.component('modal-edit-producto', require('./components/productos/ModalEditProducto.vue').default);

Vue.component('venta', require('./components/venta/Venta.vue').default);
Vue.component('edit-venta', require('./components/venta/EditVenta.vue').default);


Vue.component('compras', require('./components/compra/IndexCompra.vue').default);
Vue.component('edit-compra', require('./components/compra/EditCompra.vue').default);

Vue.component('reportes', require('./components/reporte/IndexReporte.vue').default);
Vue.component('reporte-clientes', require('./components/reporte/ReporteCliente.vue').default);


Vue.component('modal-venta-producto', require('./components/venta/ModalVentaProducto.vue').default);
Vue.component('ventas', require('./components/venta/IndexVenta.vue').default);
Vue.component('dashboard', require('./components/venta/Dashboard.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import VueRouter from 'vue-router';
Vue.use(VueRouter);

 const Venta = () => import('./components/venta/Venta.vue')
 const routes = [
    {
        path: '/nuevaventa',
        props: (route) => ({
            venId: venId,
            ...route.params
        }),
        name: 'nuevaventa',
        component: () =>
        import (
            /* webpackChunkName: "availability" */
            "./components/venta/Venta.vue"
        )
    },
   
    {
        path: 'editventa/:id',
        name: 'editventa',
        alias: 'id',
        component: () =>
            import ( /* webpackChunkName: "edit-venta" */ './components/venta/EditVenta.vue')
    },
    {
        path: 'editcompra/:id',
        name: 'editcompra',
        alias: 'id',
        component: () =>
            import ( /* webpackChunkName: "edit-compra" */ './components/compra/EditCompra.vue')
    },
];

const router = new VueRouter({
    mode: "history",
    routes
  });

const app = new Vue({
    el: '#app',
    router
    
    
});
