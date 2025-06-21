<script setup>
  import { ref } from 'vue'
  import PhoneLogin from '@/components/home/PhoneLogin.vue'
  import FingerPrintLogin from '@/components/home/FingerPrintLogin.vue'
  import { sendApi } from '@/utils/api'
  import { BASE_URL } from '@/config';
  const logo=BASE_URL+'/assets/images/logo.png'
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
    <section class="home">
      <img alt="logo" :src="logo" />
      <div>
        <PhoneLogin @validPhone="handleValidPhone" />
        <br v-if="showFingerPrint">
        <FingerPrintLogin v-if="showFingerPrint" />
      </div>
  </section>
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
    width: 100%;
    gap: 20px;
  }
  div{
    border-radius: 10px;
    background: #e0e4ed;
    width:40%;
    padding: 20px;
    box-shadow: 0 0 10px grey;
  }
  img{
    width:40%;
    height:auto;
  }
  @media screen and (max-width:600px){
    .home{
      flex-direction: column;
    }
    img{
      margin:0 auto;
      width:50%;
    }
    div{
      width:80%;
    }
  }
</style>