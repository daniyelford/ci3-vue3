import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '@/views/home/HomeView.vue'
import AboutView from '@/views/home/AboutView.vue'
import UploadView from "@/views/home/UploadView.vue";
import LoginView from '@/views/home/LoginView.vue';
import DashboardView from '@/views/dashboard/DashboardView.vue';
import RegisterView from '@/views/home/RegisterView.vue';
import { sendApi } from '@/utils/api';

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
  {
    path: '/register',
    name: 'register',
    component: RegisterView
  },
  {
    path: '/dashboard',
    name: 'dashboard',
    component: DashboardView,
    meta: { requiresAuth: true }
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

router.beforeEach(async (to, from, next) => {
  if (to.meta.requiresAuth) {
    try {
      const res = await sendApi(JSON.stringify({
        action: 'check_auth'
      }));
      if (res.status==='success') {
        next()
      } else {
        next('/login')
      }
    } catch (e) {
      console.error('Auth check failed:', e)
      next('/login')
    }
  } else {
    next()
  }
})

export default router
