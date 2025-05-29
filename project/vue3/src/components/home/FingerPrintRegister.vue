<template>
  <div v-if="isSupported">
    <button @click="registerWithWebAuthn">ثبت اثر انگشت</button>
  </div>
  <div v-else>
    مرورگر شما WebAuthn را پشتیبانی نمی‌کند.
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { sendApi } from '@/utils/api'

const isSupported = ref(false)

onMounted(() => {
  isSupported.value =
    window.PublicKeyCredential &&
    typeof window.PublicKeyCredential === 'function'
})

async function registerWithWebAuthn() {
  try {
    const res = await sendApi(JSON.stringify({
      action: 'register_webauthn_request'
    }))
    if (!res || !res.publicKey) throw new Error('مشکلی در دریافت challenge ثبت رخ داد.')
    const options = preformatMakeCredReq(res.publicKey)
    const credential = await navigator.credentials.create({
      publicKey: options
    })
    const dataToSend = JSON.stringify({
      action: 'register_webauthn_response',
      data:{
        id: credential.id,
        rawId: arrayBufferToBase64(credential.rawId),
        type: credential.type,
        response: {
          attestationObject: arrayBufferToBase64(credential.response.attestationObject),
          clientDataJSON: arrayBufferToBase64(credential.response.clientDataJSON),
        },
      }
    })
    console.log(dataToSend);
    const result = await sendApi(dataToSend)
    if (result && result.status === 'success') {
      alert('ثبت اثر انگشت موفقیت‌آمیز بود.')
    } else {
      alert('ثبت اثر انگشت ناموفق بود.')
    }

  } catch (err) {
    console.error(err)
    alert('خطا در ثبت اثر انگشت.')
  }
}

function arrayBufferToBase64(buffer) {
  return btoa(String.fromCharCode(...new Uint8Array(buffer)))
}

function preformatMakeCredReq(options) {
  options.challenge = Uint8Array.from(atob(options.challenge), c => c.charCodeAt(0)).buffer
  options.user.id = Uint8Array.from(atob(options.user.id), c => c.charCodeAt(0)).buffer

  if (options.excludeCredentials) {
    options.excludeCredentials = options.excludeCredentials.map(cred => {
      return {
        ...cred,
        id: Uint8Array.from(atob(cred.id), c => c.charCodeAt(0)).buffer
      }
    })
  }

  return options
}
</script>
