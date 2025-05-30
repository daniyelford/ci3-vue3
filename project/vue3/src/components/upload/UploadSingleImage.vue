<template>
  <div class="upload-box">
    <input type="file" @change="onFileChange" />

    <!-- progress bar -->
    <div v-if="reading" class="progress-bar">
      <div class="progress" :style="{ width: readProgress + '%' }"></div>
      <p>{{ readProgress.toFixed(0) }}%</p>
    </div>

    <!-- image preview -->
    <div v-if="imageUrl" class="preview">
      <p>تصویر آپلود شد:</p>
      <img :src="imageUrl" alt="uploaded" style="max-width: 300px;" />
    </div>
  </div>
</template>

<script setup>
  import { ref,defineProps,defineEmits } from 'vue';
  import { sendApi } from '@/utils/api';
  const emit = defineEmits(['uploaded']);
  const selectedFileBase64 = ref('');
  const imageUrl = ref('');
  // const imageId = ref('');
  const readProgress = ref(0);
  const reading = ref(false);
  const props = defineProps({
    toAction: String,
    url: String
  })
  function toBase64WithProgress(file) {
    return new Promise((resolve, reject) => {
      const reader = new FileReader();
      reading.value = true;
      readProgress.value = 0;
      reader.onprogress = (event) => {
        if (event.lengthComputable) {
          readProgress.value = (event.loaded / event.total) * 100;
        }
      };
      reader.onload = () => {
        reading.value = false;
        resolve(reader.result);
      };
      reader.onerror = error => {
        reading.value = false;
        reject(error);
      };
      reader.readAsDataURL(file);
    });
  }
  const onFileChange = async (e) => {
    const file = e.target.files[0];
    if (!file) return;
    try {
      selectedFileBase64.value = await toBase64WithProgress(file);
      await upload();
    } catch (error) {
      console.error('خطا در خواندن فایل:', error);
      alert('خطا در خواندن فایل انتخاب شده.');
    }
  };
  const upload = async () => {
    if (!selectedFileBase64.value) {
      alert('لطفاً یک فایل انتخاب کنید.');
      return;
    }
    try {
      const response = await sendApi(
        JSON.stringify({
          action: 'upload_single_image',
          url: props.url,
          data: selectedFileBase64.value,
          toAction:props.toAction
        })
      );
      if (response.status === 'success' && response.url) {
        imageUrl.value = response.url;
        // imageId.value = response.id;
        emit('uploaded', response.id);
      } else {
        alert(response.message || 'آپلود موفق نبود');
      }
    } catch (err) {
      console.error('خطا در ارسال به سرور:', err);
      alert('مشکلی در آپلود پیش آمد');
    }
  };
</script>

<style scoped>
.upload-box {
  padding: 1rem;
}

.preview {
  margin-top: 1rem;
}

.progress-bar {
  width: 100%;
  background: #eee;
  border: 1px solid #ccc;
  margin: 10px 0;
  height: 20px;
  position: relative;
  border-radius: 4px;
  overflow: hidden;
}

.progress {
  background: #4caf50;
  height: 100%;
  width: 0%;
  transition: width 0.2s ease;
}

.progress-bar p {
  position: absolute;
  left: 50%;
  transform: translateX(-50%);
  margin: 0;
  font-size: 12px;
  color: #000;
  top: 2px;
}
</style>
