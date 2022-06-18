import dashboard from '../components/backend/dashboard.vue';
import category from '../components/backend/category/manage.vue';
import addCategory from '../components/backend/category/create.vue';
export const routes = [
   {path: '/home', component:dashboard},
   {path: '/categories', component:category},
   {path: '/add-category', component:addCategory},

];

