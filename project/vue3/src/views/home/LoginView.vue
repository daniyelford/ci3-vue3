<template>
  <div class="home">
    <img alt="Vue logo" src="../../assets/logo.png">
    <PhoneLogin/>
    <FingerPrintLogin />
  </div>
</template>

<script>
import PhoneLogin from '@/components/home/PhoneLogin.vue';
import FingerPrintLogin from '@/components/home/FingerPrintLogin.vue';

export default {
  name: 'LoginView',
  components: {
    PhoneLogin,
    FingerPrintLogin
  }
}
</script>
