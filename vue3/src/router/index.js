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
    component: LoginView,
    meta:{onlyAuth:true}
  },
  {
    path: '/register',
    name: 'register',
    component: RegisterView,
    meta:{checkHasMobileId:true,onlyAuth:true}
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
  try {
    const meta = to.meta;
    if (meta.requiresAuth) {
      const res = await sendApi(JSON.stringify({ action: 'check_auth' }));
      if (res.status !== 'success') return next('/login');
    }
    if (meta.checkHasMobileId) {
      const res = await sendApi(JSON.stringify({ action: 'check_mobile_info' }));
      if (res.status !== 'success') return next('/login');
    }
    if (meta.onlyAuth) {
      const res = await sendApi(JSON.stringify({ action: 'check_auth' }));
      if (res.status === 'success') return next('/dashboard');
    }
    next();
  } catch (e) {
    console.error('Router Guard Error:', e);
    next('/login');
  }
});


export default router
