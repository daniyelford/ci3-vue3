<template>
  <div class="dashboard">
    <FingerPrintRegister/>
    <LogOutUser/>
  </div>
</template>
<script>
import FingerPrintRegister from '@/components/dashboard/FingerPrintRegister.vue';
import LogOutUser from '@/components/dashboard/LogOutUser.vue';
export default {
  name: 'DashboardView',
  components: {
    LogOutUser,
    FingerPrintRegister,
  }
}
</script>