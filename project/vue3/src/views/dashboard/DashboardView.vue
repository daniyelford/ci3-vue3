<template>
  <div class="dashboard">
    <button @click="logout">خروج</button>
    <FingerPrintRegister/>
  </div>
</template>
<script>
import FingerPrintRegister from '@/components/home/FingerPrintRegister.vue';
import router from '@/router';
import { sendApi } from '@/utils/api';
export default {
  name: 'DashboardView',
  components: {
    FingerPrintRegister
  }, methods: {
    async logout() {
      try {
        const res = await sendApi(JSON.stringify({ action: 'logout' }));
        if (res.status === 'success') {
          await router.push('/login');
        } else {
          alert('خطا در خروج از حساب');
        }
      } catch (e) {
        console.error('Logout error:', e);
      }
    }
  }
}
</script>