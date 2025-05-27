<template>
  <div class="upload-box">
    <input type="file" multiple @change="onFileChange" />

    <!-- نمایش درصد پیشرفت خواندن فایل‌ها -->
    <div v-if="reading" class="progress-bar">
      <div class="progress" :style="{ width: readProgress + '%' }"></div>
      <p>{{ readProgress.toFixed(0) }}%</p>
    </div>

    <div v-if="uploadedImages.length" class="preview">
      <p>تصاویر آپلود شده:</p>
      <div
        v-for="image in uploadedImages"
        :key="image.id"
        class="img-wrapper"
      >
        <img
          :src="image.url"
          alt="uploaded"
          style="max-width: 150px; margin: 0.5rem;"
        />
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { sendApi } from '@/utils/api';

const selectedFilesBase64 = ref([]);
const uploadedImages = ref([]);

const readProgress = ref(0);
const reading = ref(false);

function readFileAsBase64(file) {
  return new Promise((resolve, reject) => {
    const reader = new FileReader();

    reader.onload = () => resolve(reader.result);
    reader.onerror = (error) => reject(error);

    reader.readAsDataURL(file);
  });
}
async function toBase64WithProgress(files) {
  const base64s = [];
  reading.value = true;
  readProgress.value = 0;

  try {
    const total = files.length;
    for (let i = 0; i < total; i++) {
      const base64 = await readFileAsBase64(files[i]);
      base64s.push(base64);
      readProgress.value = ((i + 1) / total) * 100;
    }
    reading.value = false;
    return base64s;
  } catch (error) {
    reading.value = false;
    throw error;
  }
}
const onFileChange = async (e) => {
  const files = e.target.files;
  if (!files || files.length === 0) return;

  selectedFilesBase64.value = [];
  uploadedImages.value = [];

  try {
    selectedFilesBase64.value = await toBase64WithProgress(files);
    await uploadAll();
  } catch (error) {
    console.error('خطا در خواندن فایل‌ها:', error);
    alert('خطا در خواندن فایل‌های انتخاب شده.');
  }
};
const uploadAll = async () => {
  try {
    const response = await sendApi(
      JSON.stringify({
        action: 'upload_many_images',
        url: '',
        data: selectedFilesBase64.value
      })
    );

    if (response.status === 'success' && Array.isArray(response.images)) {
      uploadedImages.value = response.images;
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
.img-wrapper {
  display: inline-block;
  text-align: center;
}

/* progress bar styles */
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
  background: #2196f3;
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
