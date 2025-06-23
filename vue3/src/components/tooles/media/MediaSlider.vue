<template>
    <div class="media-slider" v-if="medias.length">
        <button v-if="medias.length > 1" @click="prev">⟨</button>
        <div class="media" v-if="currentMedia">
            <img v-if="currentMedia.type === 'image'" :src="currentMedia.url" alt="media" />
            <video v-else-if="currentMedia.type === 'video'" :src="currentMedia.url" controls></video>
        </div>
        <button v-if="medias.length > 1" @click="next">⟩</button>
    </div>
    <ul v-if="medias.length > 1" class="media-dots">
        <li
            v-for="(media, index) in medias"
            :key="index"
            :class="{ active: index === currentIndex }"
            @click="goTo(index)"
        ></li>
    </ul>
</template>
<script setup>
    import { ref, computed, watch ,defineProps } from 'vue'
    const props = defineProps({
        medias: {
            type: Array,
            default: () => []
        }
    })
    const currentIndex = ref(0)
    const currentMedia = computed(() => props.medias[currentIndex.value])
    function next() {currentIndex.value = (currentIndex.value + 1) % props.medias.length}
    function prev() {currentIndex.value = (currentIndex.value - 1 + props.medias.length) % props.medias.length}
    function goTo(index) {currentIndex.value = index}
    watch(() => props.medias, () => {currentIndex.value = 0})
</script>
<style scoped>
    .media-slider {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }
    .media-slider button {
        background-color: transparent;
        border: none;
        font-size: 24px;
        cursor: pointer;
        color: #333;
    }
    .media {
        width: 200px;
        height: 150px;
    }
    .media img,
    .media video {
        width: 100%;
        height: 100%;
    }
    .media-dots {
        display: flex;
        justify-content: center;
        list-style: none;
        padding: 0;
        margin-top: 10px;
        gap: 8px;
    }
    .media-dots li {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background-color: #ccc;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    .media-dots li.active {
        background-color: blue;
}
</style>