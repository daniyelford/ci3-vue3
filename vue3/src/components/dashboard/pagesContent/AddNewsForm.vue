<template>
  <UploaderManyMedia
  :url="'news_media/'"
  :toAction="'addNews'"
  @done="handleUploadResult" />
  <form @submit.prevent="submitForm">
    <div>
      <label>توضیحات</label>
      <textarea v-model="form.description" rows="4" required></textarea>
    </div>
    <div v-if="!rule">
      <label>دسته‌بندی</label>
      <multiselect
        v-model="form.category_id"
        :options="categories"
        :multiple="true"
        track-by="id"
        label="title"
        placeholder="دسته‌بندی را انتخاب کنید"
        selectLabel="برای انتخاب این مورد، اینتر بزنید"
        selectedLabel="انتخاب شده"
        deselectLabel="برای حذف این مورد، کلیک کنید"
        noOptions="موردی برای انتخاب وجود ندارد"
        noResult="نتیجه‌ای با این جستجو پیدا نشد"
      />
    </div>
    <AddressSelector
      :loginCity="address"
      :userCoordinate="userCoordinate"
      :model-value="form.user_address"
      @update="val => form.user_address = val"
      @loading="isAddressLoading = $event"
    />
    <button type="submit" :disabled="isSubmitDisabled">ثبت خبر</button>
  </form>
</template>

<script setup>
    import { ref, onMounted, computed } from 'vue'
    import { sendApi } from '@/utils/api'
    import UploaderManyMedia from '@/components/tooles/upload/UploaderManyMedia.vue'
    import Multiselect from 'vue-multiselect'
    import 'vue-multiselect/dist/vue-multiselect.min.css'
    import AddressSelector from '@/components/tooles/news/AddressSelector .vue'
    import router from '@/router'
    const categories = ref([])
    const address = ref('')
    const rule = ref(false)
    const userCoordinate=ref(null)
    const isAddressLoading = ref(false)
    const form = ref({
        category_id: [],
        user_address: { type: 'location', value: '' },
        media_id: [],
        description: '',
    })
    const handleUploadResult = (uploadedData) => {
      form.value.media_id = uploadedData.map(item => item.id)
    }
    onMounted(async () => {
        const data = await sendApi({ control: 'news', action: 'add_data' })
        if (data.status === 'success') {
            rule.value = data.rule
            address.value = data.address
            userCoordinate.value={
              lat: data.coordinate.lat,
              lon: data.coordinate.lon
            }
            if (rule.value) {
              categories.value = data.category ? [data.category] : []
              form.value.category_id = data.category ? [data.category] : []
            } else {
              categories.value = data.category ?? []
            }
        }        
    })
    const isSubmitDisabled = computed(() => {
      const isDescriptionEmpty = !form.value.description.trim()
      const isCategoryInvalid = !rule.value && (!form.value.category_id || form.value.category_id.length === 0)
      const isLocationSelected = form.value.user_address?.type === 'location'
      const isAddressInvalid = isLocationSelected && (!form.value.user_address?.value || !form.value.user_address.value.address?.trim())
      const isStillLoading = isLocationSelected && isAddressLoading.value
      console.log(form.value);
      
      
      return isDescriptionEmpty || isCategoryInvalid || isAddressInvalid || isStillLoading
    })
    const submitForm = async () => {
        const finalData = {
            ...form.value,
            category_id: form.value.category_id.map(c => c.id),
        }
        try {
            const res = await sendApi({
                control: 'news',
                action: 'add_news',
                data: finalData,
            })
            if (res.status === 'success') {
              router.push('/dashboard')
            } else {
                alert('خطا در ثبت خبر: ' + res.message)
            }
        } catch (err) {
            alert('خطا در ارسال: ' + err.message)
        }
    }
</script>

<style scoped>
  form {
    direction: rtl;
  }
  form > div {
    margin-top: 10px;
  }
  textarea {
    border-radius: 5px;
    width: 100%;
    padding: 0.5rem;
    box-sizing: border-box;
  }
  label{
    margin-bottom: 0.5rem;
    display: block;
  }
  button {
    padding: 0.5rem 1rem;
    background-color: #10b981;
    color: white;
    border: none;
    border-radius: 0.375rem;
    cursor: pointer;
    width: 100%;
    margin-top: 1rem;
    transition: background-color 0.2s ease, opacity 0.2s ease;
  }

  button:disabled {
    background-color: #9ca3af;
    cursor: not-allowed;
    opacity: 0.6;
  }

</style>
