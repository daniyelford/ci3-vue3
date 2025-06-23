<template>
  <button v-if="isSupported" @click="registerWithWebAuthn">
    <img :src="fingerPrintIcon" alt="finger print register icon">
</button>
</template>

<script setup>
  import { ref, onMounted } from 'vue'
  import { sendApi } from '@/utils/api'
  import { BASE_URL } from '@/config';
  const fingerPrintIcon=BASE_URL+'/assets/images/f.png'
  const isSupported = ref(false)
  onMounted(() => {
    isSupported.value = window.PublicKeyCredential && typeof window.PublicKeyCredential === 'function'
  })
  async function registerWithWebAuthn() {
    try {
      const res = await sendApi({
        action: 'register_webauthn_request',
        control:'login'
      })
      if (!res || !res.publicKey) throw new Error('مشکلی در دریافت challenge ثبت رخ داد.')
      const options = preformatMakeCredReq(res.publicKey)
      const credential = await navigator.credentials.create({
        publicKey: options
      })
      const result = await sendApi({
        action: 'register_webauthn_response',
        data:credential,
        control:'login'
      })
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