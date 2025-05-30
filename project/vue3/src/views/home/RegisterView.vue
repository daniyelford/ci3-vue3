<template>
  <div class="home">
    <UploadSingleImage toAction="user_mobile" url="register/" @uploaded="handleImageUpload" />
    <RegisterForm :image-id="imageId" />
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
  },
  data() {
    return {
      imageId: null
    };
  },
  methods: {
    handleImageUpload(id) {
      this.imageId = id;
    }
  }
}
</script>
