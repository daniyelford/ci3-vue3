<script setup>
import { ref } from 'vue'
import PhoneLogin from '@/components/home/PhoneLogin.vue'
import FingerPrintLogin from '@/components/home/FingerPrintLogin.vue'
import { sendApi } from '@/utils/api'
const showFingerPrint = ref(false)
async function handleValidPhone(isValid) {
  if (isValid) {
    try {
      const response = await sendApi({ 
        action:'check_mobile_has_finger_print',
        control:'login' 
      })
      if (response && response.status === 'success') {
        showFingerPrint.value = true
      } else {
        showFingerPrint.value = false
      }
    } catch (error) {
      console.error('خطا در ارتباط با سرور:', error)
      showFingerPrint.value = false
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
      <FingerPrintLogin v-if="showFingerPrint" />
  </div>
</template>
<style scoped>
  .home{
    display: flex;
    flex-direction: row-reverse;
    flex-wrap: nowrap;
    direction: rtl;
    justify-content: space-evenly;
    align-items: center;
    margin-top: 50px;
  }
  @media screen and (max-width:600px){
    .home{
      flex-direction: column;
    }
  }
</style>