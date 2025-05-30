<template>
  <div class="dashboard">
    <FingerPrintRegister/>
  </div>
</template>
<script>
import FingerPrintRegister from '@/components/home/FingerPrintRegister.vue';
export default {
  name: 'DashboardView',
  components: {
    FingerPrintRegister
  }
}
</script>