<template>
  <div class="upload">
    <UploadSingleImage />
    <UploadManyImages />
    <UploadSingleVideo />
    <UploadManyVideo />
  </div>
</template>

<script>
import UploadSingleImage from '@/components/upload/UploadSingleImage.vue';
import UploadManyImages from '@/components/upload/UploadManyImages.vue';
import UploadSingleVideo from '@/components/upload/UploadSingleVideo.vue';
import UploadManyVideo from '@/components/upload/UploadManyVideo.vue';

export default {
  name: 'UploadView',
  components: {
    UploadSingleImage,
    UploadManyImages,
    UploadSingleVideo,
    UploadManyVideo
  }
}
</script>