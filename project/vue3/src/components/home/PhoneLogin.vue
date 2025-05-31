<template>
  <div>
    <form v-if="step === 1" @submit.prevent="submitPhone">
      <label for="phone">شماره تلفن:</label>
      <input
        id="phone"
        v-model="phone"
        type="tel"
        maxlength="11"
        pattern="[0-9]*"
        placeholder="09123456789"
        required
      />
      <button v-if="showSend" :disabled="submitDisabled" type="submit">
        ارسال
        <span v-if="submitDisabled">({{ submitCountdown }} ثانیه)</span>
      </button>
      <p v-if="message">{{ message }}</p>
    </form>

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
      <button type="button" @click="editPhone" style="margin-top: 10px;">
        ویرایش شماره
      </button>
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

<script>
import { sendApi } from '@/utils/api'

export default {
  name: 'PhoneLogin',
  data() {
    return {
      phone: '',
      code: '',
      message: '',
      step: 1,
      sentOnce: false,
      showSend: false,
      resendDisabled: true,
      countdown: 120,
      countdownInterval: null,
      submitDisabled: false,
      submitCountdown: 60,
      submitInterval: null,
    }
  },
  mounted() {
    const savedPhone = sessionStorage.getItem('phone')
    const sentAt = sessionStorage.getItem('sent_at')
    if (savedPhone && sentAt) {
      const elapsed = Math.floor((Date.now() - Number(sentAt)) / 1000)
      if (elapsed < 300) {
        this.phone = savedPhone
        this.step = 2
        this.showSend = true
        this.sentOnce = true
        this.startCountdown(120 - elapsed)
      } else {
        sessionStorage.removeItem('phone')
        sessionStorage.removeItem('sent_at')
      }
    }
    const submitLockedAt = localStorage.getItem('submit_locked_at')
    const submitCountdownStored = localStorage.getItem('submit_countdown')
    if (submitLockedAt && submitCountdownStored) {
      const submitElapsed = Math.floor((Date.now() - Number(submitLockedAt)) / 1000)
      const remaining = Number(submitCountdownStored) - submitElapsed
      if (remaining > 0) {
        this.startSubmitLock(remaining)
      } else {
        localStorage.removeItem('submit_locked_at')
        localStorage.removeItem('submit_countdown')
      }
    }
  },
  watch: {
    phone: {
      handler: async function (newVal) {
        const isValid = /^09\d{9}$/.test(newVal)
        if (isValid && !this.sentOnce) {
          try {
            const response = await sendApi(JSON.stringify({ action: 'save_phone', data: newVal }))
            if (response.status === 'success') {
              this.sentOnce = true
              this.showSend = true
              this.$emit('validPhone', true)
            }
          } catch (e) {
            console.error('خطا در ارسال شماره:', e)
          }
        } else if (!isValid && this.sentOnce) {
          try {
            const responseDel = await sendApi(JSON.stringify({ action: 'delete_phone' }))
            if (responseDel.status === 'success') {
              this.sentOnce = false
              this.showSend = false
              this.$emit('validPhone', false)
            }
          } catch (e) {
            console.error('خطا در حذف شماره:', e)
          }
        }
      },
    },
  },
  methods: {
    startCountdown(seconds = 120) {
      this.resendDisabled = true
      this.countdown = seconds
      if (this.countdownInterval) clearInterval(this.countdownInterval)
      this.countdownInterval = setInterval(() => {
        this.countdown--
        if (this.countdown <= 0) {
          this.resendDisabled = false
          clearInterval(this.countdownInterval)
        }
      }, 1000)
    },
    startSubmitLock(seconds = 60) {
      this.submitDisabled = true
      this.submitCountdown = seconds
      localStorage.setItem('submit_locked_at', Date.now().toString())
      localStorage.setItem('submit_countdown', this.submitCountdown.toString())
      if (this.submitInterval) clearInterval(this.submitInterval)
      this.submitInterval = setInterval(() => {
        this.submitCountdown--
        localStorage.setItem('submit_countdown', this.submitCountdown.toString())
        if (this.submitCountdown <= 0) {
          this.submitDisabled = false
          clearInterval(this.submitInterval)
          localStorage.removeItem('submit_locked_at')
          localStorage.removeItem('submit_countdown')
        }
      }, 1000)
    },
    async submitPhone() {
      if (this.submitDisabled) return
      try {
        const response = await sendApi(JSON.stringify({ action: 'send_phone_login', data: this.phone }))
        if (response.status === 'success') {
          this.message = 'شماره با موفقیت ارسال شد. لطفاً کد پیامکی را وارد کنید.'
          this.step = 2
          this.showSend = true
          this.sentOnce = true
          this.startCountdown()
          this.startSubmitLock()
          sessionStorage.setItem('phone', this.phone)
          sessionStorage.setItem('sent_at', Date.now().toString())
        } else {
          this.message = response.message || 'ارسال موفق نبود'
        }
      } catch (error) {
        this.message = 'خطا در ارسال شماره.'
        console.error(error)
      }
    },
    async submitCode() {
      try {
        const response = await sendApi(
          JSON.stringify({
            action: 'verify_sms_code',
            data: { phone: this.phone, code: this.code },
          })
        )
        if (response.status === 'success') {
          sessionStorage.removeItem('phone')
          sessionStorage.removeItem('sent_at')
          localStorage.removeItem('submit_locked_at')
          localStorage.removeItem('submit_countdown')
          if (response.url === 'dashboard') {
            this.$router.push({ name: 'dashboard' })
          } else if (response.url === 'register') {
            this.$router.push({ name: 'register' })
          } else {
            this.message = 'مشخصات ناقص است. لطفاً دوباره تلاش کنید.'
          }
        } else {
          this.message = 'کد وارد شده اشتباه است.'
        }
      } catch (error) {
        this.message = 'خطا در تأیید کد.'
        console.error(error)
      }
    },
    editPhone() {
      this.step = 1
      this.message = ''
      this.code = ''
      this.sentOnce = false
      this.showSend = true
      sessionStorage.removeItem('phone')
      sessionStorage.removeItem('sent_at')
      if (this.countdownInterval) clearInterval(this.countdownInterval)
      localStorage.removeItem('submit_locked_at')
      localStorage.removeItem('submit_countdown')
      this.startSubmitLock()
    },
    async resendCode() {
      if (this.resendDisabled) return
      try {
        const response = await sendApi(JSON.stringify({ action: 'send_phone_login', data: this.phone }))
        if (response.status === 'success') {
          this.message = 'کد مجدداً ارسال شد.'
          this.startCountdown()
          sessionStorage.setItem('sent_at', Date.now().toString())
        } else {
          this.message = response.message || 'ارسال مجدد موفق نبود'
        }
      } catch (error) {
        this.message = 'خطا در ارسال مجدد کد.'
        console.error(error)
      }
    },
  },
  beforeUnmount() {
    if (this.countdownInterval) clearInterval(this.countdownInterval)
    if (this.submitInterval) clearInterval(this.submitInterval)
  },
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
