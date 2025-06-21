<template>
    <form @submit.prevent="submitPhone">
        <p class="msg" v-if="message">{{ message }}</p>
        <label for="phone">شماره تلفن</label>
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
            <span v-if="submitDisabled">({{ remainingTime }} ثانیه)</span>
        </button>
    </form>
</template>
<script setup>
    import { ref,watch,onMounted ,onUnmounted,defineEmits } from 'vue'
    import { sendApi } from '@/utils/api'
    const message=ref('')
    const submitDisabled=ref(false)
    const sentOnce=ref(false)
    const showSend=ref(false)
    const remainingTime=ref(0)
    const emit = defineEmits(['success', 'valid'])
    const phone=ref('')
    let interval=null;
    watch(phone,async (val) => {
        const isValid = /^09\d{9}$/.test(val)
        if (isValid && !sentOnce.value) {
            try {
                const response = await sendApi({ 
                    action: 'save_phone',
                    data: val,
                    control:'login'
                })
                if (response.status === 'success') {
                    sentOnce.value = true
                    showSend.value = true
                    emit('valid', true)
                }
            } catch (e) {
                console.error('خطا در ارسال شماره:', e)
            }
        } else if (!isValid && sentOnce.value) {
            try {
                const responseDel = await sendApi({ 
                    control:'security',
                    action: 'delete_phone'
                })
                if (responseDel.status === 'success') {
                    sentOnce.value = false
                    showSend.value = false
                    emit('valid', false)
                }
            } catch (e) {
                console.error('خطا در حذف شماره:', e)
            }
        }
    })
    const submitPhone= async () => {
        if (submitDisabled.value) return
        try {
            const response = await sendApi({ 
                action: 'send_phone_login',
                data: phone.value,
                control:'login'
            })
            if (response.status === 'success') {
                message.value = 'شماره با موفقیت ارسال شد. لطفاً کد پیامکی را وارد کنید.'
                sessionStorage.setItem('login_step', '2')
                sessionStorage.setItem('phone', phone.value)
                const now = Date.now()
                const expireTime = now + 60000 
                sessionStorage.setItem('resend_code_timer', expireTime)
                startTimer()
                emit('success', phone.value)
                showSend.value = true
                sentOnce.value = true
            } else {
                message.value = response.message || 'ارسال موفق نبود'
            }
        } catch (error) {
            message.value = 'خطا در ارسال شماره.'
            console.error(error)
        }
    }
    const startTimer = () => {
        const now = Date.now()
        const expireTime = now + 30000 
        sessionStorage.setItem('submit_phone_timer', expireTime)
        updateRemainingTime()
        interval = setInterval(updateRemainingTime, 1000)
    }
    const updateRemainingTime = () => {
        submitDisabled.value=true
        const expireTime = parseInt(sessionStorage.getItem('submit_phone_timer') || 0)
        const now = Date.now()
        const diff = Math.ceil((expireTime - now) / 1000)
        remainingTime.value = diff > 0 ? diff : 0
        if (remainingTime.value <= 0 && interval) {
            submitDisabled.value=false
            clearInterval(interval)
            interval = null
        }
    }
    onMounted(() => {
        updateRemainingTime()
        interval = setInterval(updateRemainingTime, 1000)
    })
    onUnmounted(() => {
        if (interval) clearInterval(interval)
    })
</script>
<style scoped>
    form {
        width: 100%;
    }
    .msg{
        border-radius: 10px;
        background-color: #5e6295;
        color: #fefff8;
        padding: 10px;
        text-align: center;
        margin: 5px auto;
    }
    label,
    input,
    button {
        display: block;
        width: 100%;
        margin-bottom: 10px;
    }
    label{
        text-align: center;
    }
    button{
        background-color: green;
        color: white;
        padding: 9px;
        border-radius: 10px;
        border: none;
        margin-top: 10px;
    }
    button[disabled] {
        opacity: 0.6;
        background-color: rgb(143, 141, 141);
        cursor: not-allowed;
    }
    input {
        box-sizing: border-box;
        padding: 7px;
        border: none;
        outline: none;
        border-radius: 10px;
        background-color: #edefff;
    }
</style>