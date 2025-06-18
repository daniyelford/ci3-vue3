import { createRouter, createWebHistory } from 'vue-router'
import UploadView from "@/views/home/UploadView.vue";
import LoginView from '@/views/home/LoginView.vue';
import DashboardView from '@/views/dashboard/DashboardView.vue';
import RegisterView from '@/views/home/RegisterView.vue';
import { sendApi } from '@/utils/api';

const routes = [
  {
    path: '/upload',
    name: 'upload',
    component: UploadView
  },
  {
    path: '/',
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
      const res = await sendApi({ 
        action: 'check_auth' ,
        control:'security'
       });
      if (res.status !== 'success') return next('/');
    }
    if (meta.checkHasMobileId) {
      const res = await sendApi({ 
        action: 'check_mobile_info',
        control:'security'
      });
      if (res.status !== 'success') return next('/');
    }
    if (meta.onlyAuth) {
      const res = await sendApi({ 
        action: 'check_auth',
        control:'security'
      });
      if (res.status === 'success') return next('/dashboard');
    }
    next();
  } catch (e) {
    console.error('Router Guard Error:', e);
    next('/');
  }
});


export default router
