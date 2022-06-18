require('./bootstrap');
window.Vue = require('vue').default;
import {Form, HasError, AlertError} from 'vform';
window.Form = Form;
// Vue.component(HasError.name, HasError);
import Swal from 'sweetalert2'
window.Swal = Swal;

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })
 window.Toast = Toast;
import Vuex from 'vuex';
Vue.use(Vuex);

import {storeData} from './store/store';

const store = new Vuex.Store({
    storeData
});

import VueRouter from 'vue-router';

Vue.use(VueRouter);

import {routes} from './routes/routes';
import Vue from 'vue';
const router = new VueRouter({
    routes,
    mode:"history",
});




Vue.component('dashboard', require('./components/backend/dashboard.vue').default);


const app = new Vue({
    el: '#content',
    router,
    store
});
