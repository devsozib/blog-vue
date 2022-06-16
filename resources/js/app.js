require('./bootstrap');
window.Vue = require('vue').default;

import VueRouter from 'vue-router';

Vue.use(VueRouter);
const routes = [

  ];

const router = new VueRouter({
    routes,
    mode:"history",
});

Vue.component('dashboard', require('./components/backend/dashboard.vue').default);


const app = new Vue({
    el: '#content',
    router
});
