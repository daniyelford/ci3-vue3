<template>
  <div class="home">
    <img alt="Vue logo" src="../../assets/logo.png">
    <PhoneLogin/>
  </div>
</template>

<script>
import PhoneLogin from '@/components/home/PhoneLogin.vue';

export default {
  name: 'LoginView',
  components: {
    PhoneLogin
  }
}
</script>
