import Vue from 'vue'
import VueRouter from 'vue-router'
import Feed from '../components/Feed.vue'
import Amis from '../components/Amis.vue'
import Settings from '../components/Settings.vue'

//CRUD
import PostList from '../components/CRUD/Posts/list.vue'
import PostShow from '../components/CRUD/Posts/show.vue'
import PostAdd from '../components/CRUD/Posts/add.vue'

Vue.use(VueRouter)

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
    path: '/friend/user',
    name: 'Amis',
    component: Amis
  },
  //CRUD POST
  {
    path: "/posts",
    alias: "/posts",
    name: "posts",
    component: PostList
  },
  {
    path: "/posts/:id",
    name: "posts-details",
    component: PostShow
  },
  {
    path: "/addPost",
    name: "addPost",
    component: PostAdd
  }

]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
