<script setup>
  import { ref } from 'vue'
  import PhoneLogin from '@/components/home/PhoneLogin.vue'
  import FingerPrintLogin from '@/components/home/FingerPrintLogin.vue'
  import { sendApi } from '@/utils/api'
  import { BASE_URL } from '@/config';
  const cityIcon=BASE_URL+'/assets/images/city.png'
  const carIcon=BASE_URL+'/assets/images/car.png'
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
        <svg viewBox="0 0 800 400" xmlns="http://www.w3.org/2000/svg">
            <image :href="cityIcon" x="0" y="0" width="800" height="400" />
            <g>
                <image :href="carIcon" width="300" height="150">
                <animateTransform
                    attributeName="transform"
                    type="translate"
                    from="-250 280"
                    to="900 280"
                    dur="2s"
                    repeatCount="indefinite" />
                </image>
            </g>
        </svg>
      <div>
        <img alt="logo" :src="logo" />
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
    width: 100%;
    gap: 20px;
  }
  div{
    border-radius: 10px;
    text-align:center;
    width:40%;
    padding: 20px;
    box-shadow: 0 0 10px grey;
  }
  img{
    width:100%;
  }
  @media screen and (max-width:600px){
    .home{
      flex-direction: column;
    }
    div{
      width:80%;
    }
  }
</style>