<template>
  <div class="upload">
    <UploadSingleImage />
    <UploadManyImages />
    <UploadSingleVideo />
    <UploadManyVideos />
    <UploadSinglePdf />
    <UploadManyPdfs />
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