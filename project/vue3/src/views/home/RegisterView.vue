<template>
  <div class="home">
    <UploadSingleImage toAction="" url="" />
    <RegisterForm/>
  </div>
</template>

<script>
import RegisterForm from '@/components/home/RegisterForm.vue';
import UploadSingleImage from '@/components/upload/UploadSingleImage.vue';
export default {
  name: 'RegisterView',
  components: {
    RegisterForm,
    UploadSingleImage
  }
}
</script>
