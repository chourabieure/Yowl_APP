require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router'
import store from './store'
import Vuelidate from 'vuelidate'
import moment from 'moment'

import Feed from './components/Feed.vue'
import Amis from './components/Amis.vue'
import Settings from './components/Settings.vue'
import CRUD from './components/CRUD.vue'

import CRUD_USER      from './components/CRUD/user/list.vue'
import CRUD_USER_ADD  from './components/CRUD/user/add.vue'
import CRUD_USER_SHOW from './components/CRUD/user/show.vue'
import CRUD_USER_EDIT from './components/CRUD/user/edit.vue'

import CRUD_POST      from './components/CRUD/post/list.vue'
// import CRUD_POST_ADD  from './components/CRUD/post/add.vue'
import CRUD_POST_SHOW from './components/CRUD/post/show.vue'
import CRUD_POST_EDIT from './components/CRUD/post/edit.vue'

import Menu from './views/Menu.vue'

Vue.filter('formatDate', function(value) {
  if (value) {
    return moment(String(value)).format('DD/MM/YYYY hh:mm')
  }
})
// Init
Vue.use(VueRouter);
Vue.use(Vuelidate)
Vue.component('menu-component', Menu);

const routes = [
   
    {
        path: '/',
        name: 'Feed',
        component: Feed,
        props:true
      },
      {
        path: '/settings',
        name: 'Settings',
        component: Settings,
        props:true
      },
      {
        path: '/friends',
        name: 'Amis',
        component: Amis,
        props:true
      },
      {
        path: '/admin',
        name: 'CRUD',
        component: CRUD,
        props:true
      },
      //CRUD USER
      {
        path: '/admin/users',
        name: 'CRUD_USER',
        component: CRUD_USER,
        props:true
      },
      {
        path: '/admin/users/add',
        name: 'CRUD_USER_ADD',
        component: CRUD_USER_ADD,
        props:true
      },
      {
        path: '/admin/users/show/:id',
        name: 'CRUD_USER_SHOW',
        component: CRUD_USER_SHOW,
        props:true
      },
      {
        path: '/admin/users/edit/:id',
        name: 'CRUD_USER_EDIT',
        component: CRUD_USER_EDIT,
        props:true
      },
      //CRUD POSTS
      {
        path: '/admin/posts',
        name: 'CRUD_POST',
        component: CRUD_POST,
        props:true
      },
      // {
      //   path: '/admin/posts/add',
      //   name: 'CRUD_POST_ADD',
      //   component: CRUD_POST_ADD,
      //   props:true
      // },
      {
        path: '/admin/posts/show/:id',
        name: 'CRUD_POST_SHOW',
        component: CRUD_POST_SHOW,
        props:true
      },
      {
        path: '/admin/posts/edit/:id',
        name: 'CRUD_POST_EDIT',
        component: CRUD_POST_EDIT,
        props:true
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
