<template>
  <div class="home">
    <RegisterForm/>
    <FingerPrintRegister/>
  </div>
</template>

<script>
import RegisterForm from '@/components/home/RegisterForm.vue';
import FingerPrintRegister from '@/components/home/FingerPrintRegister.vue';
export default {
  name: 'RegisterView',
  components: {
    RegisterForm,
    FingerPrintRegister
  }
}
</script>
