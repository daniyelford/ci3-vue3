import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import AboutView from '../views/AboutView.vue'
import UploadView from "../views/UploadView.vue";
import LoginView from '@/views/LoginView.vue';

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/about',
    name: 'about',
    component: AboutView
  },
  {
    path: '/upload',
    name: 'upload',
    component: UploadView
  },
  {
    path: '/login',
    name: 'login',
    component: LoginView
  },
]
const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})
export default router