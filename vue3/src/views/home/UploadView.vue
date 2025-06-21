<template>
  <div class="upload">
    <UploadSingleImage toAction="" url="" />
    <UploadManyImages toAction="" url="" />
    <UploadSingleVideo toAction="" url="" />
    <UploadManyVideos toAction="" url="" />
    <UploadSinglePdf toAction="" url="" />
    <UploadManyPdfs toAction="" url="" />
  </div>
</template>

<script setup>
import UploadSingleImage from '@/components/tooles/upload/UploadSingleImage.vue';
import UploadManyImages from '@/components/tooles/upload/UploadManyImages.vue';
import UploadSingleVideo from '@/components/tooles/upload/UploadSingleVideo.vue';
import UploadManyVideos from '@/components/tooles/upload/UploadManyVideos.vue';
import UploadSinglePdf from '@/components/tooles/upload/UploadSinglePdf.vue';
import UploadManyPdfs from '@/components/tooles/upload/UploadManyPdfs.vue';
</script>