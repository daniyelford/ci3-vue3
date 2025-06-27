<template>
    <div v-if="show" class="modal-overlay">
        <div class="modal-content">
            <button @click="$emit('close')" class="modal-close">×</button>
            <h2 class="modal-title">جزئیات رویداد</h2>
            <p class="modal-item"><strong>توضیحات:</strong> {{ event?.news?.description || 'ندارد' }}</p>
            <div class="modal-item" v-if="event?.news?.media?.length">
                <MediaSlider :medias="event.news.media" class="mt-4" />
            </div>
            <p class="modal-item">
                <strong>آدرس:</strong>
                {{ event?.news?.address?.address || 'ثبت نشده' }}
            </p>
            <p class="modal-item">
                <strong>شهر:</strong> {{ event?.news?.address?.city || '---' }}
            </p>
            <p class="modal-item">
                <strong>کاربر:</strong> {{ event?.news?.user_name || '---' }}
            </p>
        </div>
    </div>
</template>
<script setup>
    import { defineProps , defineEmits} from 'vue'
    import MediaSlider from '@/components/tooles/media/MediaSlider.vue'
    defineProps({
        show: Boolean,
        event: Object
    })
    defineEmits(['close'])
</script>
<style scoped>
    .modal-overlay {
        position: fixed;
        inset: 0;
        z-index: 9999;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .modal-content {
        background-color: #fff;
        border-radius: 1rem;
        max-width: 600px;
        width: 100%;
        padding: 1.5rem;
        position: relative;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }
    .modal-title {
        font-size: 1.25rem;
        font-weight: bold;
        margin-bottom: 1rem;
    }
    .modal-close {
        position: absolute;
        top: 0.75rem;
        left: 0.75rem;
        background: none;
        border: none;
        font-size: 1.5rem;
        color: #666;
        cursor: pointer;
    }
    .modal-close:hover {
        color: #e53935;
    }
    .modal-item {
        margin-bottom: 0.75rem;
    }
    .media-container {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-top: 0.5rem;
    }
    .media-img {
        width: 6rem;
        height: 6rem;
        object-fit: cover;
        border-radius: 0.5rem;
        border: 1px solid #ddd;
    }
</style>
