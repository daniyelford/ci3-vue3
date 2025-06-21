<template>
  <div class="home">
    <div class="image-inner">
      <UploadSingleImage toAction="user_mobile" url="register/" @uploaded="handleImageUpload" />
    </div>
    <div class="register-inner">
      <RegisterForm :image-id="imageId" />
    </div>
  </div>
</template>

<script setup>
import RegisterForm from '@/components/home/RegisterForm.vue';
import UploadSingleImage from '@/components/tooles/upload/UploadSingleImage.vue';
import { ref } from 'vue';
const imageId=ref(null)
const handleImageUpload = (id) => {
  imageId.value = id;
}
</script>
<style scoped>
  .home{
    display: flex;
    flex-direction: row-reverse;
    flex-wrap: nowrap;
    direction: rtl;
    justify-content: space-evenly;
    align-items: center;
    margin-top: 50px;
    width: 100%;
    gap: 20px;
  }
  .image-inner,.register-inner{
    width: 40%;
    margin: 0 5%;
    height: 300px;
  }
  .image-inner{
    background-color: #1a6785;
    border-radius: 10px;
    box-shadow: 0 0 10px grey;
  }
  @media screen and (max-width:600px){
    .home{
      flex-direction: column;
      margin-top: 20px;
    }
    .image-inner,.register-inner{
      width: 90%;
    }
  }
</style>