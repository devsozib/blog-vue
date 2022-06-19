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

import {storeData} from './store/store.js';

const store = new Vuex.Store(
    {
        state:{
            categoryData:[]
         },
         getters:{
            categories(state){
              return state.categoryData;
            }
         },
         actions:{
            getCategories(data){

                axios.get("get-categories").then((response)=>{
                        data.commit("categories", response.data.categories);
                }).catch((error)=>{
                    console.log(error);
                })
            }
         },
         mutations:{
             categories(state, data){
                   state.categoryData = data;
             }
         }

    }
);

import VueRouter from 'vue-router';

Vue.use(VueRouter);

import {routes} from './routes/routes';
import Vue from 'vue';
const router = new VueRouter({
    routes,

});




Vue.component('dashboard', require('./components/backend/dashboard.vue').default);


const app = new Vue({
    el: '#content',
    router,
    store
});
