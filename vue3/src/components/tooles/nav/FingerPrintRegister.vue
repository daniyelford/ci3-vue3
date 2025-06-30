<template>
  <button v-if="isSupported && !props.hasFinger && !isSuccess" @click="registerWithWebAuthn">
    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0,0,256,256"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(5.33333,5.33333)"><path d="M5,28h38v14h-38z" fill="#3c9331"></path><path d="M14,40h-7v-7h2v5h5zM41,40h-7v-2h5v-5h2z" fill="#45de32"></path><path d="M41,13h-2v-5h-5v-2h7zM9,13h-2v-7h7v2h-5z" fill="#121212"></path><path d="M32.1,32.3c0.2,0.1 0.3,0.1 0.5,0.1c0.5,0 0.9,-0.3 1.2,-0.8c0.3,-0.6 0,-1.4 -0.7,-1.6c-0.3,-0.1 -0.5,-0.2 -0.7,-0.3h-4.6c1.1,0.9 2.5,1.8 4.3,2.6zM32.7,33.1v0c-0.1,0 -0.2,0 -0.3,0c-2.7,0 -5.1,-1.2 -6.9,-3.5h-3.1c2.3,3.8 5.9,6 10,6c0.1,0 0.2,0 0.3,0c0.7,0 1.2,-0.6 1.2,-1.3c0.1,-0.6 -0.5,-1.2 -1.2,-1.2zM27.4,35.6c-2.9,-1.3 -4.4,-2.4 -6.2,-4.9c-0.2,-0.3 -0.4,-0.7 -0.6,-1h-2.8c0.4,0.9 0.9,1.8 1.4,2.5c2,2.8 3.9,4.3 7.2,5.7c0.2,0.1 0.3,0.1 0.5,0.1c0.5,0 0.9,-0.3 1.2,-0.8c0.3,-0.6 0,-1.3 -0.7,-1.6z" fill="#60ff28"></path><path d="M13.3,22.9c-0.1,0 -0.1,0 0,0c-0.8,-0.1 -1.3,-0.7 -1.3,-1.4c0,-0.3 0.5,-6.4 5.3,-10c3.5,-2.5 7.2,-2.5 9,-2.5h0.3c0.7,0 1.3,0.6 1.3,1.3c0,0.7 -0.6,1.3 -1.3,1.3h-0.3c-1.6,0 -4.6,0 -7.4,2.1c-3.9,2.9 -4.3,8.1 -4.3,8.1c-0.1,0.6 -0.7,1.1 -1.3,1.1zM26.8,23c0,-0.7 -0.5,-1.3 -1.2,-1.3c-0.7,0 -1.3,0.5 -1.3,1.2c0,0.2 0,2.5 2.1,5.1h3.7c-3.2,-2.3 -3.3,-4.8 -3.3,-5z" fill="#4e3918"></path><path d="M34.3,26.4c-1.7,-0.9 -2.6,-2.7 -3.5,-4.4c-1.2,-2.4 -2.8,-5.6 -7,-3.8c-1.3,0.6 -2.3,1.6 -2.8,3c-0.9,2.3 -0.3,5 0.6,6.7c0,0.1 0.1,0.1 0.1,0.2h2.9c-0.2,-0.4 -0.5,-0.8 -0.7,-1.3c-0.8,-1.6 -1,-3.5 -0.5,-4.8c0.3,-0.8 0.8,-1.3 1.5,-1.6c1.8,-0.8 2.3,-0.2 3.7,2.7c0.8,1.7 1.8,3.6 3.7,5h2.7c0.2,-0.7 -0.1,-1.4 -0.7,-1.7z" fill="#4e3918"></path><path d="M19.9,28c-0.8,-2 -1.2,-4.4 -0.8,-6.5c0.4,-1.9 1.5,-3.3 3.2,-4.3c1.9,-1.1 3.6,-1.3 5.2,-0.7c2.9,1.1 4.9,4.8 6.1,7.7c0.3,0.6 1,1 1.6,0.7c0.6,-0.3 1,-1 0.7,-1.6c-1.3,-3.4 -3.7,-7.7 -7.5,-9.1c-2.3,-0.8 -4.7,-0.5 -7.2,0.9c-2.3,1.3 -3.9,3.3 -4.5,5.9c-0.5,2.3 -0.2,4.9 0.5,7.1h2.7z" fill="#4e3918"></path><path d="M5,28h38v2h-38z" fill="#d7347d"></path></g></g></svg>
  </button>
  <RouterLink v-else to="user-setting">
    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0,0,256,256"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(2,2)"><path d="M101.1,105.6c-7.4,-12.9 -21.2,-21.6 -37.1,-21.6v0c-15.9,0 -29.7,8.7 -37.1,21.6l0.1,3.4h74z" fill="#e0e84e"></path><path d="M109.7,88h-17.4c-1.1,0 -2.1,0.6 -2.6,1.5l-8.7,15c-0.5,0.9 -0.5,2.1 0,3l8.7,15c0.5,0.9 1.5,1.5 2.6,1.5h17.3c1.1,0 2.1,-0.6 2.6,-1.5l8.7,-15c0.5,-0.9 0.5,-2.1 0,-3l-8.7,-15c-0.5,-0.9 -1.5,-1.5 -2.5,-1.5z" fill="#4f3661"></path><path d="M101,97c-4.97056,0 -9,4.02944 -9,9c0,4.97056 4.02944,9 9,9c4.97056,0 9,-4.02944 9,-9c0,-4.97056 -4.02944,-9 -9,-9z" fill="#e0e84e"></path><path d="M78.8,89.7c-0.3,0 -0.7,-0.1 -1,-0.2c-4.4,-1.6 -9,-2.5 -13.8,-2.5c-1.7,0 -3,-1.3 -3,-3c0,-1.7 1.3,-3 3,-3c5.5,0 10.8,1 15.9,2.8c1.6,0.6 2.3,2.3 1.8,3.9c-0.5,1.2 -1.7,2 -2.9,2z" fill="#000000"></path><path d="M26.9,108.6c-0.5,0 -1,-0.1 -1.5,-0.4c-1.4,-0.8 -1.9,-2.6 -1.1,-4.1c8.1,-14.2 23.3,-23.1 39.7,-23.1c1.7,0 3,1.3 3,3c0,1.7 -1.3,3 -3,3c-14.2,0 -27.4,7.7 -34.5,20.1c-0.5,0.9 -1.5,1.5 -2.6,1.5z" fill="#000000"></path><path d="M64,30c-11.04569,0 -20,8.95431 -20,20c0,11.04569 8.95431,20 20,20c11.04569,0 20,-8.95431 20,-20c0,-11.04569 -8.95431,-20 -20,-20z" fill="#e0e84e"></path><g fill="#000000"><path d="M64,73c-12.7,0 -23,-10.3 -23,-23c0,-12.7 10.3,-23 23,-23c12.7,0 23,10.3 23,23c0,12.7 -10.3,23 -23,23zM64,33c-9.4,0 -17,7.6 -17,17c0,9.4 7.6,17 17,17c9.4,0 17,-7.6 17,-17c0,-9.4 -7.6,-17 -17,-17z"></path></g></g></g></svg>
  </RouterLink>
</template>
<script setup>
  import { ref , onMounted , defineProps } from 'vue'
  import { sendApi } from '@/utils/api'
  const isSupported = ref(false)
  const isSuccess = ref(false)
  const props=defineProps({
    hasFinger:Boolean
  })
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
        isSuccess.value=true
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