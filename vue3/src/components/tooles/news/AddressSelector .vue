<template>
  <div>
    <label class="address-label">انتخاب آدرس</label>
    <RadioGroup
      v-model="selectedMode"
      :options="addressModes"
      name="address-mode"
    />
    <div class="section" v-if="selectedMode === 'location'">
      <label class="text">موقعیت مکانی</label>
      <MapPicker :center="props.userCoordinate" @pick="handleMapSelect" />
      <span class="loading" v-if="loading">در حال دریافت آدرس از نقشه...</span>
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
    userCoordinate: {
      type: Object,
      default: () => ({ lat: '', lon: '' })
    }
  })
  const addressModes = computed(() => {
    const modes = []
    if (props.loginCity) {
      modes.push({ id: 'city', label: `شهر فعلی ${props.loginCity}` })
    }
    modes.push({ id: 'location', label: 'انتخاب از نقشه' })
    return modes
  })
  const selectedMode = ref(
    props.loginCity
      ? props.modelValue?.type || 'city'
      : 'location'
  )
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
    } catch (e) {
      location.value.address = 'خطا در دریافت آدرس'
    } finally {
      loading.value = false
      emit('update', { type: 'location', value: location.value })
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
  .loading{
    position: relative;
    top: -275px;
    right: 10px;
    color: #ff005c;
  }
  .address-label {
    font-weight: bold;
    margin-bottom: 0.75rem;
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
    border-radius: 5px;
    padding: 0.5rem;
    width: 34%;
    height: 300px;
    resize: vertical;
    display: inline-block;
    margin-top: 0.75rem;
    margin-right: 1%;
    box-sizing: border-box;
  }
  @media screen and (max-width: 600px) {
    .loading{
      position: unset;
      padding: 10px;
    }
    .textarea {
      width: 100%;
      height: 80px;
      margin-right: 0;
    }
  }
</style>