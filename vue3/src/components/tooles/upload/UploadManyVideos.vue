<template>
  <div class="upload-box">
    <input type="file" multiple accept="video/*" @change="onFileChange" />

    <!-- نمایش درصد پیشرفت خواندن فایل‌ها -->
    <div v-if="reading" class="progress-bar">
      <div class="progress" :style="{ width: readProgress + '%' }"></div>
      <p>{{ readProgress.toFixed(0) }}%</p>
    </div>

    <div v-if="uploadedVideos.length" class="preview">
      <p>ویدیوهای آپلود شده:</p>
      <div v-for="video in uploadedVideos" :key="video.id" class="video-wrapper">
        <video :src="video.url" controls style="max-width: 400px; max-height: 300px; margin: 0.5rem;"></video>
      </div>
    </div>
  </div>
</template>

<script setup>
  import { ref,defineProps } from 'vue'
  import { sendApi } from '@/utils/api' // متد دلخواه برای ارسال API
  const MAX_FILE_SIZE_MB = 100
  const selectedFilesBase64 = ref([])
  const uploadedVideos = ref([])
  const props = defineProps({
    toAction: String,
    url: String
  })
  const readProgress = ref(0)
  const reading = ref(false)
  function readFileAsBase64(file) {
    return new Promise((resolve, reject) => {
      const reader = new FileReader()
      reader.onload = () => resolve(reader.result)
      reader.onerror = (error) => reject(error)
      reader.readAsDataURL(file)
    })
  }
  async function toBase64WithProgress(files) {
    const base64s = []
    reading.value = true
    readProgress.value = 0
    try {
      const total = files.length
      for (let i = 0; i < total; i++) {
        const file = files[i]
        const sizeInMB = file.size / (1024 * 1024)
        if (sizeInMB > MAX_FILE_SIZE_MB) {
          alert(`فایل ${file.name} بیشتر از ${MAX_FILE_SIZE_MB}MB است و آپلود نمی‌شود.`)
          continue
        }
        const base64 = await readFileAsBase64(file)
        base64s.push(base64)
        readProgress.value = ((i + 1) / total) * 100
      }
      reading.value = false
      return base64s
    } catch (error) {
      reading.value = false
      throw error
    }
  }
  const onFileChange = async (e) => {
    const files = e.target.files
    if (!files || files.length === 0) return
    selectedFilesBase64.value = []
    uploadedVideos.value = []
    try {
      selectedFilesBase64.value = await toBase64WithProgress(files)
      await uploadAll()
    } catch (error) {
      console.error('خطا در خواندن فایل‌ها:', error)
      alert('خطا در خواندن فایل‌های ویدیو.')
    }
  }
  const uploadAll = async () => {
    try {
      const response = await sendApi(
        {
          action: 'upload_many_videos',
          data: {
            data:selectedFilesBase64.value,
            url:props.url,
            toAction:props.toAction,
          },
          control:'upload'
        }
      )
      if (response.status === 'success' && Array.isArray(response.videos)) {
        uploadedVideos.value = response.videos
      } else {
        alert(response.message || 'آپلود موفق نبود')
      }
    } catch (err) {
      console.error('خطا در ارسال به سرور:', err)
      alert('مشکلی در آپلود پیش آمد')
    }
  }
</script>

<style scoped>
.upload-box {
  padding: 1rem;
}
.preview {
  margin-top: 1rem;
}
.video-wrapper {
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
