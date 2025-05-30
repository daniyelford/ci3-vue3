<script setup>
import { ref } from 'vue'
import PhoneLogin from '@/components/home/PhoneLogin.vue'
import FingerPrintLogin from '@/components/home/FingerPrintLogin.vue'
import { sendApi } from '@/utils/api'
const showFingerPrint = ref(false)
const loading = ref(false)
async function handleValidPhone(isValid) {
  if (isValid) {
    loading.value = true
    try {
      const response = await sendApi(JSON.stringify({action:'check_mobile_has_finger_print'}))
      if (response && response.status === 'success') {
        showFingerPrint.value = true
      } else {
        showFingerPrint.value = false
      }
    } catch (error) {
      console.error('خطا در ارتباط با سرور:', error)
      showFingerPrint.value = false
    } finally {
      loading.value = false
    }
  } else {
    showFingerPrint.value = false
  }
}
</script>
<template>
    <div class="home">
      <img alt="Vue logo" src="../../assets/logo.png" />
      <PhoneLogin @validPhone="handleValidPhone" />
      <div v-if="loading">در حال بررسی شماره...</div>
      <FingerPrintLogin v-if="showFingerPrint" />
  </div>
</template>
