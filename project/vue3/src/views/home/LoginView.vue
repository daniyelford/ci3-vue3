<script>
import { ref } from 'vue'
import PhoneLogin from '@/components/home/PhoneLogin.vue'
import FingerPrintLogin from '@/components/home/FingerPrintLogin.vue'

export default {
  name: 'LoginView',
  components: {
    PhoneLogin,
    FingerPrintLogin
  },
  setup() {
    const isValidPhone = ref(false)

    return {
      isValidPhone
    }
  }
}
</script>

<template>
  <div class="home">
    <img alt="Vue logo" src="../../assets/logo.png" />
    <PhoneLogin @validPhone="isValidPhone = $event" />
    <FingerPrintLogin v-if="isValidPhone" />
  </div>
</template>
