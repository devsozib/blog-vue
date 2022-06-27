window.Vue = require('vue').default;

 //Vuex From Here
import Vuex from 'vuex';
Vue.use(Vuex);

const store = new Vuex.Store(
       {
        state:{
            categoryData:[],
            postData:[]
         },
         getters:{
            categories(state){
              return state.categoryData;
            },
            posts(state){
                return state.postData;
              },
         },
         actions:{
            getCategories(data){

                axios.get("/get-categories").then((response)=>{
                        data.commit("categories", response.data.categories);
                }).catch((error)=>{
                    console.log(error);
                })
            },
            getActiveCategories(data){

                axios.get("categories/get-active-categories").then((response)=>{
                        data.commit("categories", response.data.categories);
                }).catch((error)=>{
                    console.log(error);
                })
            },
            getPosts(data){
                axios.get("/get-posts").then((response)=>{
                    data.commit("posts", response.data.posts);
                }).catch((error)=>{
                console.log(error);
               })
            }
         },
         mutations:{
             categories(state, data){
                   state.categoryData = data;
             },

             posts(state, data){
                state.postData = data;
             },

         }

    }
);

//Vue Router From Here
import VueRouter from 'vue-router';
Vue.use(VueRouter);
import {routes} from './routes/routes';
import Vue from 'vue';
const router = new VueRouter({
    routes,

});

//Vue Filter From Here

Vue.filter('subString',(content, length)=>{
          return content.substring(0, length);
});

//Mixin

import './helpers/mixin.js';

import PublicMaster from  "./components/frontend/FrontendMaster.vue";
// Vue.component('public-master', require('./components/frontend/FrontendMaster.vue').default);

const app = new Vue({
    el: '#content',
    router,
    store,
    components:{
        'public-master':PublicMaster,
    }
});
