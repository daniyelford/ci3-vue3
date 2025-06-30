<template>
    <div v-if="show" class="modal-overlay">
        <div class="modal-content">
            <button @click="$emit('close')" class="modal-close">×</button>
            <div class="modal-item user" v-if="!event?.me">
                <div class="user-info">
                    <img
                    v-if="event?.news?.user?.image"
                    :src="event.news.user.image"
                    alt="عکس کاربر"
                    class="media-img"/>
                    <svg v-else class="media-img" xmlns="http://www.w3.org/2000/svg" fill="#000000" enable-background="new 0 0 24 24" viewBox="0 0 24 24"><g><rect fill="none" height="24" width="24"/></g><g><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 4c1.93 0 3.5 1.57 3.5 3.5S13.93 13 12 13s-3.5-1.57-3.5-3.5S10.07 6 12 6zm0 14c-2.03 0-4.43-.82-6.14-2.88C7.55 15.8 9.68 15 12 15s4.45.8 6.14 2.12C16.43 19.18 14.03 20 12 20z"/></g></svg>
                    {{ [event?.news?.user?.name, event?.news?.user?.family].filter(Boolean).join(' ') || '---' }}
                </div>
                <div class="">
                    <a v-if="event?.news?.user?.phone" :href="'tel:'+event?.news?.user?.phone">
                        <svg version="1.1" class="tooles" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0,0,256,256"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(4,4)"><path d="M1,32c0,-17.1 13.9,-31 31,-31c17.1,0 31,13.9 31,31c0,17.1 -13.9,31 -31,31c-17.1,0 -31,-13.9 -31,-31z" fill="#3ec81c"></path><path d="M43.1,51.4c-0.7,0 -1.3,-0.1 -1.9,-0.4c-3.6,-1.6 -10.6,-5.1 -16.8,-11.3c-6.2,-6.2 -9.8,-13.3 -11.4,-16.9c-0.8,-1.8 -0.4,-3.9 1.1,-5.4l3.8,-3.8c0.5,-0.5 1.1,-0.9 1.8,-1c1,-0.2 2,0.2 2.7,0.9l4.9,4.9c1.3,1.3 1.3,3.4 0,4.8l-3.9,3.9c-0.4,0.4 -0.5,1 -0.3,1.5c0.7,1.5 2.3,4.6 5,7.3c2.7,2.7 5.8,4.3 7.3,5c0.5,0.2 1.1,0.1 1.5,-0.3l4,-4c0.5,-0.5 1,-0.8 1.7,-0.9c1,-0.2 2,0.1 2.8,0.9l5.1,5.1c1.2,1.2 1.2,3.2 0,4.4l-3.9,3.9c-0.9,0.9 -2.2,1.4 -3.5,1.4z" fill="#54e6eb"></path></g></g></svg>
                    </a>
                </div>
            </div>
            <div class="modal-item" v-if="event?.news?.media?.length">
                <MediaSlider :medias="event.news.media" />
            </div>
            <p class="modal-item"><strong>توضیحات:</strong> {{ event?.news?.description || 'ندارد' }}</p>
            <p class="modal-item">
                <strong>آدرس:</strong>
                {{ event?.news?.address?.address || 'ثبت نشده' }}
            </p>
            <RouterLink v-if="event?.news?.id" :to="{ path:`/show-cartable/${event.news.id}` }" class="done">
                {{ event?.me?'پیگیری':'بررسی' }}
            </RouterLink>
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
    .done {
        width: 100%;
        padding: 10px;
        background: #7fffd4;
        color: black;
        text-decoration: none;
        cursor: pointer;
        border-radius: 5px;
        font-size: 15px;
        font-weight: 700;
        display: inline-block;
        text-align: center;
        box-sizing: border-box;
    }
    .user-info{
        display: flex;
        flex-direction: row-reverse;
        align-items: center;
        gap: 10px;
    }
    .tooles{
        width: 25px;
        height: 25px;
    }
    .user{
        display: flex;
        flex-direction: row-reverse;
        align-items: center;
        justify-content: space-between;
        flex-wrap: nowrap;
    }
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
        direction: rtl;
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
        width: 50px;
        height: 50px;
        border-radius: 50px;
        object-fit: cover;
        border: 1px solid #ddd;
    }
</style>
