import dashboard from '../components/backend/dashboard.vue';
//Category Component

import category from '../components/backend/category/manage.vue';
import addCategory from '../components/backend/category/create.vue';
import editCategory from '../components/backend/category/edit.vue';

//Post Controller
import posts from '../components/backend/posts/manage.vue';
import addPosts from '../components/backend/posts/create.vue';
import editPosts from '../components/backend/posts/edit.vue';
//FrontEnd
import Home from '../components/frontend/Home.vue';
import About from '../components/frontend/About.vue';
import PostByCategory from '../components/frontend/byCategory.vue';
import PostDetails from '../components/frontend/PostDetails.vue';

export const routes = [
   {path: '/home', component:dashboard},
   //For Category Router
   {path: '/categories', component:category},
   {path: '/add-category', component:addCategory},
   {path: '/edit-category/:slug', component:editCategory},


   //For Posts Router
   {path: '/posts', component:posts},
   {path: '/add-post', component:addPosts},
   {path: '/edit-posts/:id', component:editPosts},


   //Frontend Routes

   {path:'/', component:Home},
   {path:'/about' , component:About},
   {path: '/by-category/:slug', component:PostByCategory},
   {path: '/details/:id', component:PostDetails},
];

