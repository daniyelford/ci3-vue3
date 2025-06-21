<template>
  <div>
    <PhoneForm v-if=" step === 1" @success="goStep2" @valid="validPhoneNumber"/>
    <SmsLoginForm v-else-if=" step === 2" :phone="phone" @back="step = 1"/>
  </div>
</template>
<script setup>
  import { ref,watch,onMounted,defineEmits } from 'vue'
  import PhoneForm from '@/components/home/PhoneLogin/PhoneForm.vue'
  import SmsLoginForm from '@/components/home/PhoneLogin/SmsLoginForm.vue'
  const step=ref(1)
  const phone=ref('')
  const emit = defineEmits(['validPhone'])
  onMounted(() => {
    const savedStep = sessionStorage.getItem('login_step')
    const savedPhone = sessionStorage.getItem('phone')
    if (savedStep) step.value = parseInt(savedStep)
    if (savedPhone) {phone.value = savedPhone }else{ step.value =1}
  })
  watch(step, val => sessionStorage.setItem('login_step', val))
  watch(phone, val => sessionStorage.setItem('phone', val))
  const goStep2=(val)=>{
    if(val){
      phone.value=val
      step.value=2
    }else{
      step.value=1
    }
  }
  const validPhoneNumber=(val)=>{
    emit('validPhone', val)
  }
</script>

<style scoped>
  div{
    border-radius: 10px;
    background: #e0e4ed;
    padding: 20px;
    box-shadow: 0 0 10px grey;
  }
</style>
