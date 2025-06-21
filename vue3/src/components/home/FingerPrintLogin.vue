<template>
    <button v-if="isSupported" @click="loginWithWebAuthn">
        <img :src="fingerPrintIcon" alt="finger print login icon">
    </button>
</template>
<script setup>
    import { ref, onMounted } from 'vue'
    import { sendApi } from '@/utils/api'
    import router from '@/router'
    import { BASE_URL } from '@/config';
    const fingerPrintIcon=BASE_URL+'/assets/images/fin.png'
    const isSupported = ref(false)
    onMounted(() => {
        isSupported.value = window.PublicKeyCredential && typeof window.PublicKeyCredential === 'function'
    })
    async function loginWithWebAuthn() {
        try {
            const res = await sendApi({
                action: 'login_webauthn_request',
                control:'login'
            })
            if (!res || !res.publicKey) {
                if (res.status === 'error') {
                    alert(res.message)
                } else {
                    throw new Error('مشکلی در دریافت challenge رخ داد.')
                }
                return
            }
            const options = preformatGetReq(res.publicKey)
            const assertion = await navigator.credentials.get({
                publicKey: options
            })
            const verify = await sendApi({
                action: 'login_webauthn_response',
                data:assertion,
                control:'login'
            })
            if (verify.status==='success') {
                if (verify.url === 'dashboard') {
                    router.push({ name: 'dashboard' })
                } else if (verify.url === 'register') {
                    router.push({ name: 'register' })
                } else {
                    this.message = 'مشخصات ناقص است. لطفاً دوباره تلاش کنید.'
                }
            } else {
                alert('احراز هویت ناموفق بود.')
            }
        } catch (err) {
            console.error(err)
            alert('خطا در ورود با اثر انگشت')
        }
    }
    function decodeMimeBase64(mimeString) {
        const match = mimeString.match(/=\?BINARY\?B\?(.*)\?=/i)
        if (match && match[1]) {
        return Uint8Array.from(atob(match[1]), c => c.charCodeAt(0)).buffer
        }
        return Uint8Array.from(atob(mimeString), c => c.charCodeAt(0)).buffer
    }
    function preformatGetReq(options) {
        const opts = { ...options }
        opts.challenge = decodeMimeBase64(opts.challenge)
        if (opts.allowCredentials && Array.isArray(opts.allowCredentials)) {
            opts.allowCredentials = opts.allowCredentials.map(cred => ({
            ...cred,
            id: decodeMimeBase64(cred.id)
            }))
        }
        return opts
    }
</script>
<style scoped>
    button{
        border: none;
        outline: none;
        width: 35px;
        height: 35px;
        cursor: pointer;
        padding: 0;
        background: transparent;
    }
    img{
        height: 100%;
        width: 100%;
    }
</style>