<template>
  <div>
    <label class="address-label">نوع آدرس:</label>
    <RadioGroup
      v-model="selectedMode"
      :options="addressModes"
      name="address-mode"
    />
    <div class="section" v-if="selectedMode === 'location'">
      <label class="text">موقعیت مکانی:</label>
      <MapPicker @pick="handleMapSelect" />
      <p v-if="loading">در حال دریافت آدرس از نقشه...</p>
      <textarea
        v-if="!loading"
        v-model="location.address"
        rows="3"
        class="textarea"
        placeholder="آدرس انتخاب ‌شده را کامل کنید...">
      </textarea>
    </div>
  </div>
</template>
<script setup>
  import { ref, watch, defineEmits, defineProps, computed } from 'vue'
  import RadioGroup from '@/components/tooles/news/address/RadioGroup.vue'
  import MapPicker from '@/components/tooles/news/address/MapPicker.vue'
  import { fullAddress } from '@/utils/geo'
  const emit = defineEmits(['update','loading'])
  const props = defineProps({
    loginCity: String,
    modelValue: Object,
  })
  const addressModes = computed(() => [
    { id: 'city', label: `شهر فعلی ${props.loginCity || ''}` },
    { id: 'location', label: 'انتخاب از نقشه' },
  ])
  const selectedMode = ref(props.modelValue?.type || 'city')
  const location = ref(props.modelValue?.value || { lat: '', lng: '', address: '' })
  const loading = ref(false)
  const handleMapSelect = async ({ lat, lng }) => {
    location.value.lat = lat
    location.value.lng = lng
    loading.value = true
    try {
      const result = await fullAddress(lat, lng)
      location.value.total = result || ''
      location.value.address = result.display_name || ''
      emit('update', { type: 'location', value: location.value })
    } catch (e) {
      location.value.address = 'خطا در دریافت آدرس'
    } finally {
      loading.value = false
    }
  }
  watch([selectedMode, location], () => {
    let value = null
    if (selectedMode.value === 'city') {
      value = { type: 'city', value: props.loginCity }
    } else if (selectedMode.value === 'location') {
      value = { type: 'location', value: location.value }
    }
    emit('update', value)
  })
  watch(loading, () => {
    emit('loading', loading.value)
  })
</script>

<style scoped>
  .address-label {
    font-weight: bold;
    margin-bottom: 0.5rem;
    display: block;
  }
  .section {
    margin-top: 1rem;
  }
  .text {
    font-size: 0.875rem;
    margin-bottom: 0.25rem;
    display: block;
  }
  .textarea {
    border: 1px solid #ccc;
    border-radius: 0.375rem;
    padding: 0.5rem;
    width: 100%;
    resize: vertical;
    margin-top: 0.5rem;
  }
</style>