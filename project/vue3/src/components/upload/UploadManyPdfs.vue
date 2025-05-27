<template>
  <div class="upload-box">
    <input type="file" accept="application/pdf" multiple @change="onFilesChange" />

    <div v-if="uploading" class="progress-message">در حال آپلود...</div>

    <div v-if="uploadedFiles.length" class="uploaded-list">
      <p>PDFهای آپلودشده:</p>
      <ul>
        <li v-for="(file, index) in uploadedFiles" :key="index">
          <a :href="file.url" target="_blank" rel="noopener noreferrer">{{ file.name }}</a>
        </li>
      </ul>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { sendApi } from '@/utils/api'

const MAX_FILE_SIZE_MB = 10
const selectedFiles = ref([])
const uploadedFiles = ref([])
const uploading = ref(false)

const onFilesChange = async (e) => {
  const files = Array.from(e.target.files)
  selectedFiles.value = []

  for (const file of files) {
    const sizeInMB = file.size / (1024 * 1024)
    if (sizeInMB > MAX_FILE_SIZE_MB) {
      alert(`فایل ${file.name} بیش از ${MAX_FILE_SIZE_MB}MB است و انتخاب نمی‌شود`)
      continue
    }
    selectedFiles.value.push(file)
  }

  // ریست کردن input برای اجازه انتخاب مجدد
  e.target.value = ''

  if (selectedFiles.value.length > 0) {
    await uploadFiles()
  }
}

const uploadFiles = async () => {
  uploading.value = true
  uploadedFiles.value = []

  const fileDataArray = []

  for (const file of selectedFiles.value) {
    try {
      const base64 = await readFileAsBase64(file)
      fileDataArray.push({
        name: file.name,
        content: base64,
      })
    } catch {
      alert(`خطا در خواندن فایل ${file.name}`)
    }
  }

  try {
    const response = await sendApi(
      JSON.stringify({
        action: 'upload_many_pdfs',
        data: fileDataArray,
      })
    )

    if (response.status === 'success' && Array.isArray(response.pdfs)) {
      uploadedFiles.value = response.pdfs
      selectedFiles.value = []
    } else {
      alert(response.message || 'آپلود دسته‌ای موفق نبود')
    }
  } catch (err) {
    console.error('خطا در آپلود:', err)
    alert('خطا در ارسال فایل‌ها')
  } finally {
    uploading.value = false
  }
}

const readFileAsBase64 = (file) => {
  return new Promise((resolve, reject) => {
    const reader = new FileReader()
    reader.onload = () => resolve(reader.result)
    reader.onerror = () => reject(new Error('خواندن فایل با خطا مواجه شد'))
    reader.readAsDataURL(file)
  })
}
</script>

<style scoped>
.upload-box {
  padding: 1rem;
}
input[type="file"] {
  margin-bottom: 1rem;
}
.progress-message {
  margin-top: 1rem;
  color: #ff9800;
}
.uploaded-list {
  margin-top: 1rem;
}
.uploaded-list ul {
  padding: 0;
  list-style: none;
}
.uploaded-list li {
  margin: 0.3rem 0;
}
.uploaded-list a {
  color: #4caf50;
  font-weight: bold;
  text-decoration: none;
}
.uploaded-list a:hover {
  text-decoration: underline;
}
</style>
