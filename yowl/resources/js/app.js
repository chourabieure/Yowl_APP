require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router'
import Feed from './components/Feed.vue'
import Amis from './components/Amis.vue'
import Settings from './components/Settings.vue'
import Menu from './views/Menu.vue'


// Init
Vue.use(VueRouter);
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

]
const router = new VueRouter({
    routes,
    mode: 'history'
});


const app = new Vue({
    el: '#app',
    router: router,
    components: {
        Menu
      }
});
