<template>
  <div v-if="isSupported">
    <button @click="loginWithWebAuthn">
      ورود با اثر انگشت
    </button>
  </div>
</template>

<script setup>
    import { ref, onMounted } from 'vue'
    import { sendApi } from '@/utils/api'
    import router from '@/router'
    const isSupported = ref(false)
    onMounted(() => {
        isSupported.value =
        window.PublicKeyCredential &&
        typeof window.PublicKeyCredential === 'function'
    })
    async function loginWithWebAuthn() {
        try {
            const res = await sendApi(JSON.stringify({
                action: 'login_webauthn_request'
            }))
            if (!res || !res.publicKey) throw new Error('مشکلی در دریافت challenge رخ داد.')
            const options = preformatGetReq(res.publicKey)
            const assertion = await navigator.credentials.get({
                publicKey: options
            })
            const dataToSend = JSON.stringify({
                action: 'login_webauthn_response',
                id: assertion.id,
                rawId: arrayBufferToBase64(assertion.rawId),
                type: assertion.type,
                response: {
                    clientDataJSON: arrayBufferToBase64(assertion.response.clientDataJSON),
                    authenticatorData: arrayBufferToBase64(assertion.response.authenticatorData),
                    signature: arrayBufferToBase64(assertion.response.signature),
                    userHandle: assertion.response.userHandle
                    ? arrayBufferToBase64(assertion.response.userHandle)
                    : null,
                },
            })
            console.log(dataToSend);
            const verify = await sendApi(dataToSend)
            if (verify && verify.success) {
                router.push({name:'dashboard'})
            } else {
                alert('احراز هویت ناموفق بود.')
            }
        } catch (err) {
            console.error(err)
            alert('خطا در ورود با اثر انگشت')
        }
    }
    function arrayBufferToBase64(buffer) {
        return btoa(String.fromCharCode(...new Uint8Array(buffer)))
    }
    function preformatGetReq(options) {
        const opts = {...options}
        opts.challenge = Uint8Array.from(atob(opts.challenge), c => c.charCodeAt(0)).buffer
        if (opts.allowCredentials && Array.isArray(opts.allowCredentials)) {
            opts.allowCredentials = opts.allowCredentials.map(cred => ({
            ...cred,
            id: Uint8Array.from(atob(cred.id), c => c.charCodeAt(0)).buffer
            }))
        }
        return opts
    }
</script>
