<template>
  <form @submit.prevent="submitRegister">
    <h2>تکمیل ثبت‌نام</h2>

    <label for="name">نام:</label>
    <input id="name" v-model="name" type="text" required />

    <label for="family">نام خانوادگی:</label>
    <input id="family" v-model="family" type="text" required />

    <button type="submit">ثبت‌نام</button>

    <p v-if="message">{{ message }}</p>
  </form>
</template>

<script setup>
import { ref,defineProps } from 'vue'
import { useRouter } from 'vue-router'
import { sendApi } from '@/utils/api'
const props = defineProps({
  imageId: Number
});
const name = ref('')
const family = ref('')
const message = ref('')
const router = useRouter()

const submitRegister = async () => {
  try {
    const response = await sendApi(
      JSON.stringify({
        action: 'register_user',
        data: {
          name: name.value,
          family: family.value,
          image_id: props.imageId
        },
      })
    )
    if (response.status === 'success') {
        router.push({ name: 'dashboard' })
    } else {
        message.value = 'مشخصات ناقص است. لطفاً دوباره تلاش کنید.'
    }
  } catch (error) {
    message.value = 'خطا در ثبت‌نام.'
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
</style>
