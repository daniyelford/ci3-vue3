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

<script>
import UploadSingleImage from '@/components/upload/UploadSingleImage.vue';
import UploadManyImages from '@/components/upload/UploadManyImages.vue';
import UploadSingleVideo from '@/components/upload/UploadSingleVideo.vue';
import UploadManyVideos from '@/components/upload/UploadManyVideos.vue';
import UploadSinglePdf from '@/components/upload/UploadSinglePdf.vue';
import UploadManyPdfs from '@/components/upload/UploadManyPdfs.vue';

export default {
  name: 'UploadView',
  components: {
    UploadSingleImage,
    UploadManyImages,
    UploadSingleVideo,
    UploadManyVideos,
    UploadSinglePdf,
    UploadManyPdfs
  }
}
</script>