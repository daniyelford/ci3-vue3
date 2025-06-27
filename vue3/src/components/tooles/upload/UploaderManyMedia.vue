<template>
  <div class="drop-area" @click="fileInput.click()" @dragover.prevent @dragenter.prevent @drop.prevent="handleDrop">
    <svg fill="currentColor" viewBox="0 0 97.6 77.3" width="96">
        <title>
          فایل‌ها را بکشید و رها کنید یا کلیک کنید
        </title>
        <path d="M16.3 24h.3c2.8-.2 4.9-2.6 4.8-5.4-.2-2.8-2.6-4.9-5.4-4.8s-4.9 2.6-4.8 5.4c.1 2.7 2.4 4.8 5.1 4.8zm-2.4-7.2c.5-.6 1.3-1 2.1-1h.2c1.7 0 3.1 1.4 3.1 3.1 0 1.7-1.4 3.1-3.1 3.1-1.7 0-3.1-1.4-3.1-3.1 0-.8.3-1.5.8-2.1z" fill="currentColor"></path><path d="M84.7 18.4 58 16.9l-.2-3c-.3-5.7-5.2-10.1-11-9.8L12.9 6c-5.7.3-10.1 5.3-9.8 11L5 51v.8c.7 5.2 5.1 9.1 10.3 9.1h.6l21.7-1.2v.6c-.3 5.7 4 10.7 9.8 11l34 2h.6c5.5 0 10.1-4.3 10.4-9.8l2-34c.4-5.8-4-10.7-9.7-11.1zM7.2 10.8C8.7 9.1 10.8 8.1 13 8l34-1.9c4.6-.3 8.6 3.3 8.9 7.9l.2 2.8-5.3-.3c-5.7-.3-10.7 4-11 9.8l-.6 9.5-9.5 10.7c-.2.3-.6.4-1 .5-.4 0-.7-.1-1-.4l-7.8-7c-1.4-1.3-3.5-1.1-4.8.3L7 49 5.2 17c-.2-2.3.6-4.5 2-6.2zm8.7 48c-4.3.2-8.1-2.8-8.8-7.1l9.4-10.5c.2-.3.6-.4 1-.5.4 0 .7.1 1 .4l7.8 7c.7.6 1.6.9 2.5.9.9 0 1.7-.5 2.3-1.1l7.8-8.8-1.1 18.6-21.9 1.1zm76.5-29.5-2 34c-.3 4.6-4.3 8.2-8.9 7.9l-34-2c-4.6-.3-8.2-4.3-7.9-8.9l2-34c.3-4.4 3.9-7.9 8.4-7.9h.5l34 2c4.7.3 8.2 4.3 7.9 8.9z" fill="currentColor"></path><path d="M78.2 41.6 61.3 30.5c-2.1-1.4-4.9-.8-6.2 1.3-.4.7-.7 1.4-.7 2.2l-1.2 20.1c-.1 2.5 1.7 4.6 4.2 4.8h.3c.7 0 1.4-.2 2-.5l18-9c2.2-1.1 3.1-3.8 2-6-.4-.7-.9-1.3-1.5-1.8zm-1.4 6-18 9c-.4.2-.8.3-1.3.3-.4 0-.9-.2-1.2-.4-.7-.5-1.2-1.3-1.1-2.2l1.2-20.1c.1-.9.6-1.7 1.4-2.1.8-.4 1.7-.3 2.5.1L77 43.3c1.2.8 1.5 2.3.7 3.4-.2.4-.5.7-.9.9z" fill="currentColor"></path></svg>
    <input type="file" multiple ref="fileInput" class="hidden-input" @change="handleFiles" />
  </div>
  <div v-if="uploading" class="uploading-box">
    <p>در حال آماده‌سازی فایل‌ها برای ارسال...</p>
    <progress :value="progress" min="0" max="100" class="progress-bar"></progress>
  </div>
  <div v-if="mediaList.length > 0" class="preview-box">
    <p>پیش‌نمایش</p>
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
        emit('done', mediaList.value)
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
        direction: rtl;
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
        width: 100%;
      }
    }
</style>