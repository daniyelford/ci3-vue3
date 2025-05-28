<template>
  <form @submit.prevent="submitPhone">
    <label for="phone">شماره تلفن:</label>
    <input
      id="phone"
      v-model="phone"
      type="text"
      placeholder="مثلاً 09123456789"
      required
    />
    <button type="submit">ارسال</button>
    <p v-if="message">{{ message }}</p>
  </form>
</template>

<script setup>
import { ref } from 'vue'

const phone = ref('')
const message = ref('')

// const submitPhone = async () => {
//   try {
//     const response = await axios.post('http://localhost:8000/api/phone', {
//       phone: phone.value
//     })
//     message.value = 'شماره با موفقیت ارسال شد.'
//     phone.value = ''
//   } catch (error) {
//     message.value = 'خطا در ارسال شماره.'
//     console.error(error)
//   }
// }
</script>

<style scoped>
form {
  max-width: 300px;
  margin: auto;
}
label, input, button {
  display: block;
  width: 100%;
  margin-bottom: 10px;
}
</style>
