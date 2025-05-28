<template>
  <div>
    <!-- مرحله اول: ارسال شماره موبایل -->
    <form v-if="step === 1" @submit.prevent="submitPhone">
      <label for="phone">شماره تلفن:</label>
      <input
        id="phone"
        v-model="phone"
        type="text"
        placeholder="مثلاً 09123456789"
        required
      />
      <button type="submit">ارسال</button>
      <p v-if="message">{{ message }}</p>
    </form>

    <!-- مرحله دوم: وارد کردن کد پیامکی -->
    <form v-else-if="step === 2" @submit.prevent="submitCode">
      <label for="code">کد پیامک شده:</label>
      <input
        id="code"
        v-model="code"
        type="text"
        placeholder="کد تأیید"
        required
      />
      <button type="submit">تأیید کد</button>

      <!-- دکمه ویرایش شماره -->
      <button type="button" @click="editPhone" style="margin-top: 10px;">
        ویرایش شماره
      </button>

      <!-- دکمه ارسال مجدد کد -->
      <button
        type="button"
        @click="resendCode"
        :disabled="resendDisabled"
        style="margin-top: 10px;"
      >
        ارسال مجدد کد
        <span v-if="resendDisabled">({{ countdown }} ثانیه)</span>
      </button>

      <p v-if="message">{{ message }}</p>
    </form>
  </div>
</template>

<script setup>
import { sendApi } from '@/utils/api'
import { ref } from 'vue'
import { useRouter } from 'vue-router'
const router = useRouter()
const phone = ref('')
const code = ref('')
const message = ref('')
const step = ref(1)

const resendDisabled = ref(true)
const countdown = ref(120)
let countdownInterval = null

const startCountdown = () => {
  resendDisabled.value = true
  countdown.value = 120
  clearInterval(countdownInterval)
  countdownInterval = setInterval(() => {
    countdown.value--
    if (countdown.value <= 0) {
      resendDisabled.value = false
      clearInterval(countdownInterval)
    }
  }, 1000)
}

const submitPhone = async () => {
  try {
    const response = await sendApi(
      JSON.stringify({
        action: 'send_phone_login',
        data: phone.value,
      })
    )
    if (response.status === 'success') {
      message.value = 'شماره با موفقیت ارسال شد. لطفاً کد پیامکی را وارد کنید.'
      step.value = 2
      startCountdown()
    } else {
      message.value =response.message || 'ارسال موفق نبود'
    }
  } catch (error) {
    message.value = 'خطا در ارسال شماره.'
    console.error(error)
  }
}

const submitCode = async () => {
  try {
    const response = await sendApi(
      JSON.stringify({
        action: 'verify_sms_code',
        data: {
          phone: phone.value,
          code: code.value,
        },
      })
    )
    if (response.status === 'success' && response.mobile_id) {
      sessionStorage.setItem('mobile_id', response.mobile_id)
      message.value = 'ورود با موفقیت انجام شد!'
      setTimeout(() => {
        if (response.account_id && response.id) {
          sessionStorage.setItem('account_id', response.account_id)
          sessionStorage.setItem('user_id', response.id)
          router.push({ name: 'dashboard' })
        } else if (response.register === true) {
          router.push({ name: 'register' }) // صفحه ثبت نام
        } else {
          message.value = 'مشخصات ناقص است. لطفاً دوباره تلاش کنید.'
        }
      }, 1000)
    } else {
      message.value = 'کد وارد شده اشتباه است.'
    }
  } catch (error) {
    message.value = 'خطا در تأیید کد.'
    console.error(error)
  }
}

const editPhone = () => {
  step.value = 1
  message.value = ''
  code.value = ''
  clearInterval(countdownInterval)
}

const resendCode = async () => {
  if (resendDisabled.value) return
  try {
    const response = await sendApi(
      JSON.stringify({
        action: 'send_phone_login',
        data: phone.value,
      })
    )
    if (response.status === 'success') {
      message.value = 'کد مجدداً ارسال شد.'
      startCountdown()
    } else {
      message.value =response.message || 'ارسال مجدد موفق نبود'
    }
  } catch (error) {
    message.value = 'خطا در ارسال مجدد کد.'
    console.error(error)
  }
}
</script>

<style scoped>
form {
  max-width: 300px;
  margin: auto;
}
label,
input,
button {
  display: block;
  width: 100%;
  margin-bottom: 10px;
}
button[disabled] {
  opacity: 0.6;
  cursor: not-allowed;
}
</style>
