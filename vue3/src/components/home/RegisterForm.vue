<template>
  <div>
    <form @submit.prevent="submitRegister">
      <h2>تکمیل ثبت‌ نام</h2>
      <p class="msg" v-if="message">{{ message }}</p>
      <label for="name">نام</label>
      <input id="name" v-model="name" type="text" required />
      <label for="family">نام خانوادگی</label>
      <input id="family" v-model="family" type="text" required />
      <button type="submit">ثبت‌ نام</button>
    </form>
  </div>
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
        {
          action: 'register_user',
          data: {
            name: name.value,
            family: family.value,
            image_id: props.imageId
          },
          control:'login'
        }
      )
      if (response.status === 'success') {
          localStorage.setItem('isLogin', true)
          window.dispatchEvent(new Event("storage"));
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
  div{
    width: 100%;
    height: 100%;
    box-sizing: border-box;
    border-radius: 10px;
    background: #e0e4ed;
    padding: 20px;
    box-shadow: 0 0 10px grey;
  }
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
  button{
    background-color: green;
    color: white;
    padding: 15px;
    border-radius: 10px;
    border: none;
    margin-top: 10px;
  }
  input {
    padding: 10px;
    box-sizing: border-box;
    outline: none;
    border-radius: 10px;
    background-color: #edefff;
    border: none;
  }
</style>
