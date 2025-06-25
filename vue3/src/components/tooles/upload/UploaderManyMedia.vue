<template>
  <div class="drop-area" @click="fileInput.click()" @dragover.prevent @dragenter.prevent @drop.prevent="handleDrop">
    <p>فایل‌ها را بکشید و رها کنید یا کلیک کنید</p>
    <input type="file" multiple ref="fileInput" class="hidden-input" @change="handleFiles" />
  </div>
  <div v-if="uploading" class="uploading-box">
    <p>در حال آماده‌سازی فایل‌ها برای ارسال...</p>
    <progress :value="progress" min="0" max="100" class="progress-bar"></progress>
  </div>
  <div v-if="mediaList.length > 0" class="preview-box">
    <p>پیش‌نمایش فایل‌ها:</p>
    <div class="preview-list">
      <div v-for="(item, i) in mediaList" :key="item.id || i" class="preview-item">
        <button @click="deleteMedia(item, i)" class="delete-button">×</button>
        <img v-if="item.type === 'image'" :src="item.url" class="preview-image" />
        <video v-else-if="item.type === 'video'" :src="item.url" controls class="preview-video" />
      </div>
    </div>
  </div>
</template>
<script setup>
  import { ref, defineProps, defineEmits } from 'vue'
  import { sendApi } from '@/utils/api'
  const fileInput = ref(null)
  const selectedFilesBase64 = ref([])
  const progress = ref(0)
  const uploading = ref(false)
  const props = defineProps({
    url: String,
    toAction: String,
  })
  const mediaList = ref([])
  const emit = defineEmits(['done'])
  const handleDrop = (e) => {
    const files = e.dataTransfer.files
    handleFiles({ target: { files } })
  }
  const handleFiles = async (e) => {
    const files = Array.from(e.target.files)
    if (!files.length) return
    selectedFilesBase64.value = []
    uploading.value = true
    progress.value = 0
    let count = 0
    for (const file of files) {
      await new Promise((resolve) => {
        const reader = new FileReader()
        reader.onload = () => {
          const base64 = reader.result
          selectedFilesBase64.value.push(base64)
          count++
          progress.value = Math.round((count / files.length) * 100)
          resolve()
        }
        reader.readAsDataURL(file)
      })
    }
    await uploadFiles()
    uploading.value = false
  }
  const uploadFiles = async () => {
    try {
      const response = await sendApi({
        control: 'upload',
        action: 'upload_many_media',
        data: {
          url: props.url,
          data: selectedFilesBase64.value,
          toAction: props.toAction,
        },
      })
      if (response.status === 'success') {
        const uploaded = response.data
        mediaList.value.push(...uploaded)
        selectedFilesBase64.value = []
        emit('done', mediaList.value)
      } else {
        alert('آپلود با خطا مواجه شد: ' + response.message)
      }
    } catch (err) {
      alert('خطا در ارسال: ' + err.message)
    }
  }
  const deleteMedia = async (media, index) => {
    try {
      const res = await sendApi({
        control: 'upload',
        action: 'delete_media_by_id',
        data: { id: media.id },
      })
      if (res.status === 'success') {
        mediaList.value.splice(index, 1)
      } else {
        alert('حذف فایل با خطا مواجه شد: ' + res.message)
      }
    } catch (err) {
      alert('خطا در حذف: ' + err.message)
    }
  }
</script>
<style scoped>
    .drop-area {
        border: 2px dashed #d1d5db;
        padding: 1rem;
        border-radius: 0.5rem;
        text-align: center;
        cursor: pointer;
    }
    .hidden-input {
        display: none;
    }
    .select-button {
        margin-top: 0.5rem;
        padding: 0.4rem 0.8rem;
        cursor: pointer;
    }
    .uploading-box {
        margin-top: 1rem;
    }
    .progress-bar {
        width: 100%;
    }
    .preview-box {
        margin-top: 1rem;
    }
    .preview-list {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        justify-content: center;
        width: 100%;
    }
    .preview-item {
        display: flex;
        position: relative;
        flex-direction: column;
        align-items: center;
        gap: 0.5rem;
        border: 1px solid #d1d5db;
        border-radius: 0.5rem;
        padding: 0.5rem;
        width: 40%;
        height: auto;
        background-color: #f9fafb;
    }
    .preview-image {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        border: 1px solid #ccc;
    }
    .preview-video {
        max-width: 100%;
        max-height: 100%;
    }
    .file-label {
        font-size: 0.875rem;
        color: #4b5563;
    }
    .file-name {
        font-size: 0.75rem;
        color: #9ca3af;
        max-width: 100px;
        text-align: center;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
      }
    .delete-button {
        position: absolute;
        top: 4px;
        z-index: 9;
        right: 4px;
        background-color: #ef4444;
        color: white;
        border: none;
        border-radius: 9999px;
        width: 20px;
        height: 20px;
        font-size: 12px;
        line-height: 20px;
        text-align: center;
        cursor: pointer;
    }
    @media screen and (max-width:600px){
      .preview-item {
        width: 90%;
      }
    }
</style>