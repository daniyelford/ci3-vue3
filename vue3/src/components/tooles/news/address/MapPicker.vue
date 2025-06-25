<template>
    <div class="map-wrapper">
        <div id="map" class="map"></div>
    </div>
</template>
<script setup>
    import { onMounted , ref , defineEmits } from 'vue'
    import { BASE_URL } from '@/config'
    import L from 'leaflet'
    import 'leaflet/dist/leaflet.css'
    const emit = defineEmits(['pick'])
    const map = ref(null)
    const markerIcon= BASE_URL+'/assets/images/marker.svg'
    const marker = ref(null)
    onMounted(() => {
        map.value = L.map('map').setView([35.6892, 51.3890], 13)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors',
        }).addTo(map.value)
         setTimeout(() => {
            map.value.invalidateSize()
        }, 300)
        map.value.on('click', (e) => {
            const { lat, lng } = e.latlng
            if (marker.value && map.value.hasLayer(marker.value)){
                map.value.removeLayer(marker.value)
            }
            marker.value = L.marker([lat, lng], {
                icon: L.icon({
                    iconUrl: markerIcon,
                    iconSize: [32, 32],
                    iconAnchor: [16, 32],
                })
            }).addTo(map.value)
            emit('pick', { lat, lng })
        })
    })
</script>
<style scoped>
    .map-wrapper {
        width: 100%;
        height: 300px;
        margin-top: 1rem;
    }
    .map {
        width: 100%;
        height: 100%;
        border-radius: 8px;
    }
</style>