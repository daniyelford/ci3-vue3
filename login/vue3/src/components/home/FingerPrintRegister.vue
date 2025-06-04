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
    isSupported.value = window.PublicKeyCredential && typeof window.PublicKeyCredential === 'function'
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
      const result = await sendApi(JSON.stringify({
        action: 'register_webauthn_response',
        data:credential
      }))
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
  function decodeMimeBase64(mimeString) {
    const match = mimeString.match(/=\?BINARY\?B\?(.*)\?=/i)
    if (match && match[1]) {
      return Uint8Array.from(atob(match[1]), c => c.charCodeAt(0)).buffer
    }
    return Uint8Array.from(atob(mimeString), c => c.charCodeAt(0)).buffer
  }
  function preformatMakeCredReq(options) {
    const opts = { ...options }
    opts.challenge = decodeMimeBase64(opts.challenge)
    if (opts.user && opts.user.id) {
      opts.user.id = decodeMimeBase64(opts.user.id)
    }
    if (opts.excludeCredentials && Array.isArray(opts.excludeCredentials)) {
      opts.excludeCredentials = opts.excludeCredentials.map(cred => ({
        ...cred,
        id: decodeMimeBase64(cred.id)
      }))
    }
    return opts
  }
</script>
