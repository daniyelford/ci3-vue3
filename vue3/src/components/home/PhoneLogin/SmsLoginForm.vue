<template>
    <form @submit.prevent="submitCode">
        <p class="msg" v-if="message">{{ message }}</p>
        <label for="code">کد پیامک شده</label>
        <input
            id="code"
            v-model="code"
            type="text"
            placeholder="کد تأیید"
            required
        />
        <button type="submit" style="width: 49%;display: inline-block;margin-left: 1%;">تأیید کد</button>
        <button type="button" @click="editPhone" style="width: 49%;background-color: orangered;display: inline-block;margin-right: 1%;">
            ویرایش شماره
        </button>
        <button
            type="button"
            @click="resendCode"
            :disabled="resendDisabled"
            style="background-color: goldenrod;">
            ارسال مجدد کد
            <span v-if="resendDisabled">({{ countdown }} ثانیه)</span>
        </button>
    </form>
</template>
<script setup>
    import { ref,onMounted,onUnmounted,defineProps,defineEmits } from 'vue'
    import { sendApi } from '@/utils/api'
    import router from '@/router'
    const emit = defineEmits(['back'])
    const message=ref('')
    const code=ref('') 
    const resendDisabled=ref(false)
    const countdown=ref(0)
    const props = defineProps({
        phone: String
    })
    const editPhone = () => {
        sessionStorage.setItem('login_step', '1')
        code.value=''
        emit('back',true)
    }
    const submitCode=async()=>{
        try {
            const response = await sendApi({
                action: 'verify_sms_code',
                data: { phone: props.phone, code: code.value },
                control:'login'
            })
            if (response.status === 'success') {
                sessionStorage.setItem('login_step', '2')
                sessionStorage.removeItem('submit_phone_timer')
                sessionStorage.removeItem('phone')
                if (response.url === 'dashboard') {
                    sessionStorage.setItem('isLogin', true);
                    window.dispatchEvent(new Event("storage"));
                    router.push({ name: 'dashboard' })
                } else if (response.url === 'register') {
                    router.push({ name: 'register' })
                } else {
                    message.value = 'مشخصات ناقص است. لطفاً دوباره تلاش کنید.'
                }
            } else {
                message.value = 'کد وارد شده اشتباه است.'
            }
        } catch (error) {
            message.value = 'خطا در تأیید کد.'
            console.error(error)
        }
    }
    const resendCode = async () => {
        if (resendDisabled.value) return
        try {
            const response = await sendApi({ 
                action: 'send_phone_login',
                data: props.phone,
                control:'login'
            })
            if (response.status === 'success') {
                message.value = 'کد مجدداً ارسال شد.'
                startCountdown()
            } else {
                message.value = response.message || 'ارسال مجدد موفق نبود'
            }
        } catch (error) {
            message.value = 'خطا در ارسال مجدد کد.'
            console.error(error)
        }
    }
    let interval = null;
    const startCountdown = () => {
        const now = Date.now()
        const expireTime = now + 60000 
        sessionStorage.setItem('resend_code_timer', expireTime)
        updatecountdown()
        interval = setInterval(updatecountdown, 1000)
    }
    const updatecountdown = () => {
        const expireTime = parseInt(sessionStorage.getItem('resend_code_timer') || 0)
        const now = Date.now()
        const diff = Math.ceil((expireTime - now) / 1000)
        countdown.value = diff > 0 ? diff : 0
        if (countdown.value <= 0 && interval) {
            resendDisabled.value=false
            clearInterval(interval)
            interval = null
        }else{
            resendDisabled.value=true
        }
    }
    onMounted(() => {
        updatecountdown()
        interval = setInterval(updatecountdown, 1000)
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