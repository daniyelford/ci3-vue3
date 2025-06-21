<template>
  <div class="upload-box">
    <input type="file" accept="video/*" @change="onFileChange" />
    <div v-if="progress > 0" class="progress-bar-wrapper">
      <div class="progress-bar" :style="{ width: progress + '%' }"></div>
      <p>{{ progress.toFixed(0) }}%</p>
    </div>
    <div v-if="videoUrl" class="preview">
      <p>ویدئو آپلود شده:</p>
      <video :src="videoUrl" controls style="max-width: 400px; max-height: 300px;"></video>
    </div>
  </div>
</template>

<script setup>
  import { ref,defineProps } from 'vue'
  import { sendApi } from '@/utils/api'
  const props = defineProps({
    toAction: String,
    url: String
  })
  const progress = ref(0)
  const videoUrl = ref('')
  const MAX_FILE_SIZE_MB = 100
  const onFileChange = (e) => {
    const file = e.target.files[0]
    if (!file) return
    const sizeInMB = file.size / (1024 * 1024)
    if (sizeInMB > MAX_FILE_SIZE_MB) {
      alert(`اندازه فایل نباید بیشتر از ${MAX_FILE_SIZE_MB} مگابایت باشد`)
      return
    }
    progress.value = 0
    videoUrl.value = ''
    const reader = new FileReader()
    reader.onprogress = (event) => {
      if (event.lengthComputable) {
        progress.value = (event.loaded / event.total) * 100
      }
    }
    reader.onload = async () => {
      const base64Data = reader.result
      try {
        const response = await sendApi(
          {
            action: 'upload_single_video',
            data:{
              data: base64Data,
              url:props.url,
              toAction:props.toAction,
            },
            control:'upload'
          }
        )
        if (response.status === 'success' && response.url) {
          videoUrl.value = response.url
        } else {
          alert(response.message || 'آپلود موفق نبود')
        }
      } catch (err) {
        console.error('خطا در آپلود:', err)
        alert('خطا در ارسال ویدئو')
      }
    }
    reader.onerror = (err) => {
      console.error('خطا در خواندن فایل:', err)
      alert('خطا در خواندن فایل ویدیو')
    }
    reader.readAsDataURL(file)
  }
</script>

<style scoped>
  .upload-box {
    padding: 1rem;
  }
  .progress-bar-wrapper {
    margin: 1rem 0;
    width: 100%;
    background: #ddd;
    height: 20px;
    border-radius: 10px;
    overflow: hidden;
    position: relative;
  }
  .progress-bar {
    height: 100%;
    background: #2196f3;
    transition: width 0.2s ease;
  }
  .progress-bar-wrapper p {
    position: absolute;
    top: 0;
    left: 50%;
    transform: translateX(-50%);
    margin: 0;
    font-weight: bold;
    color: #333;
    line-height: 20px;
  }
  .preview {
    margin-top: 1rem;
  }
</style>
