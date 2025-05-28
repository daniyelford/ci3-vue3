<template>
  <div class="home">
    <RegisterForm/>
  </div>
</template>

<script>
import RegisterForm from '@/components/home/RegisterForm.vue';
export default {
  name: 'RegisterView',
  components: {
    RegisterForm,
  }
}
</script>
