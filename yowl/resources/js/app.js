require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router'
import store from './store'
import Vuelidate from 'vuelidate'

import Feed from './components/Feed.vue'
import Amis from './components/Amis.vue'
import Settings from './components/Settings.vue'
import CRUD from './components/CRUD.vue'
import CRUD_USER from './components/CRUD/user/list.vue'
import CRUD_USER_ADD from './components/CRUD/user/add.vue'
import Menu from './views/Menu.vue'

// Init
Vue.use(VueRouter);
Vue.use(Vuelidate)
Vue.component('menu-component', Menu);

const routes = [
   
    {
        path: '/',
        name: 'Feed',
        component: Feed
      },
      {
        path: '/settings',
        name: 'Settings',
        component: Settings
      },
      {
        path: '/friends',
        name: 'Amis',
        component: Amis
      },
      {
        path: '/admin',
        name: 'CRUD',
        component: CRUD
      },
      {
        path: '/admin/users',
        name: 'CRUD_USER',
        component: CRUD_USER
      },
      {
        path: '/admin/users/add',
        name: 'CRUD_USER_ADD',
        component: CRUD_USER_ADD
      },

]
const router = new VueRouter({
    routes,
    mode: 'history'
});


const app = new Vue({
    el: '#app',
    router: router,
    store,
    components: {
        Menu
      }
});
