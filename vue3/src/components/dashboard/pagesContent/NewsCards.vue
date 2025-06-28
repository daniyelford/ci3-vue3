<template>
    <div class="loading" v-if="!newsStore.isLoaded">
        در حال بارگذاری...
    </div>
    <div class="card-inner" v-else-if="newsStore.cards.length > 0">
        <div v-for="card in newsStore.cards" :key="card.id" class="card">
            <div class="user-info">
                <img v-if="card.user.image" :src="card.user.image" alt="user icon">
                <svg v-else xmlns="http://www.w3.org/2000/svg" fill="#000000" enable-background="new 0 0 24 24" viewBox="0 0 24 24"><g><rect fill="none" height="24" width="24"/></g><g><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 4c1.93 0 3.5 1.57 3.5 3.5S13.93 13 12 13s-3.5-1.57-3.5-3.5S10.07 6 12 6zm0 14c-2.03 0-4.43-.82-6.14-2.88C7.55 15.8 9.68 15 12 15s4.45.8 6.14 2.12C16.43 19.18 14.03 20 12 20z"/></g></svg>
                <p>{{ card.user.name + ' ' + card.user.family }}</p>
            </div>
            <div class="media-inner">
                <MediaSlider v-if="card.medias.length > 0" :medias="card.medias" />
            </div>
            <div class="card-category">
                {{ card.category }}
            </div>
            <div class="description" v-if="card.description !== ''">
                {{ card.description }}
            </div>
            <div class="location" v-if="card.location !== ''">
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0,0,256,256"><defs><linearGradient x1="11.27" y1="9.259" x2="36.73" y2="34.72" gradientUnits="userSpaceOnUse" id="color-1"><stop offset="0" stop-color="#68e7cc"></stop><stop offset="1" stop-color="#1e2471"></stop></linearGradient><radialGradient cx="24" cy="22" r="9.5" gradientUnits="userSpaceOnUse" id="color-2"><stop offset="0.177" stop-color="#4d9595"></stop><stop offset="1" stop-color="#000000" stop-opacity="0"></stop></radialGradient></defs><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(5.33333,5.33333)"><path d="M36.902,34.536c6.932,-7.126 6.775,-18.521 -0.351,-25.453c-7.126,-6.932 -18.521,-6.775 -25.453,0.35c-6.797,6.987 -6.797,18.116 0,25.103c0.018,0.019 0.03,0.04 0.048,0.059l0.059,0.059c0.047,0.048 0.094,0.095 0.142,0.142l11.239,11.239c0.781,0.781 2.047,0.781 2.828,0v0l11.239,-11.239c0.048,-0.047 0.095,-0.094 0.142,-0.142l0.059,-0.059c0.019,-0.019 0.031,-0.041 0.048,-0.059z" fill="url(#color-1)"></path><circle cx="24" cy="22" r="9.5" fill="url(#color-2)"></circle><circle cx="24" cy="22" r="8" fill="#8129bf"></circle></g></g></svg>
                {{ card.location }}
            </div>
            <div class="time">
                {{ moment(card.created_at).format('jYYYY/jMM/jDD') }}
            </div>
            <a class="choose" v-if="newsStore.hasRule" @click="openCalendarModal(card.id)">
                بررسی
            </a>
        </div>
    </div>
    <div class="none-cart-error" v-else>
        خبری در محدوده شما وجود ندارد
    </div>
    <CalendarModal
    v-if="showModal"
    @close="showModal = false"
    @submit="onCalendarSubmit" />
</template>
<script setup>
    import { ref, onMounted , onBeforeUnmount } from 'vue'
    import moment from 'moment-jalaali'
    import { sendApi } from '@/utils/api'
    import MediaSlider from '@/components/tooles/media/MediaSlider.vue'
    import CalendarModal from '@/components/tooles/news/CalendarModal.vue'
    import { useNewsStore } from '@/stores/news'
    const showModal = ref(false)
    const selectedNewsId = ref(null)
    const newsStore = useNewsStore()
    function openCalendarModal(id) {
        selectedNewsId.value = id
        showModal.value = true
    }
    async function onCalendarSubmit({ date }) {
        const jsDate = date ? moment(date, 'jYYYY/jMM/jDD').toDate() : null
        const response = await sendApi({
            action: 'add_news_to_list',
            control: 'news',
            data: {
            news_id: selectedNewsId.value,
            run_time: jsDate ?? null,
            }
        })
        if (response.status === 'success') {
            showModal.value = false
            newsStore.fetchNews()
        } else {
            alert('خطا در ثبت تاریخ اجرا')
        }
    }
    let intervalId = null
    onMounted(() => {
        newsStore.fetchNews()
        intervalId = setInterval(() => {
            newsStore.fetchNews()
        }, 6000)
    })
    onBeforeUnmount(() => {if (intervalId) clearInterval(intervalId)})
</script>
<style scoped>
    .media-inner {
        background: white;
        padding: 5px;
    }
    .location {
        margin: 5px;
        gap: 5px;
        display: flex;
        font-size: 11px;
        align-items: center;
    }
    .location svg{
        height: 20px;
        width: 20px;
    }
    .user-info svg,.user-info img{
        width: 50px;
        height: 50px;
        border-radius: 50px;
        display: inline-block;
    }
    .user-info p{
        display: inline-block;
    }
    .user-info{
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px;
    }
    .card-category {
        text-align: center;
        padding: 10px;
        background: floralwhite;
    }
    .card-inner {
        width: 100%;
        direction: rtl;
        height: 100%;
        display: flex;
        flex-direction: row-reverse;
        flex-wrap: wrap;
        align-content: flex-start;
        justify-content: center;
        align-items: stretch;
    }
    .card {
        background: #f5f5f5;
        width: 49%;
        min-height: 300px;
        margin: 0 0.5% 10px 0.5%;
        border-radius: 10px;
        box-shadow: 0 0 5px grey;
    }
    .media {
        height: 150px;
        width: auto;
        margin: auto;
    }
    .media img,
    .media video {
        width: 100%;
        height: 100%;
    }
    .card-header {
        display: flex;
        flex-direction: row-reverse;
        flex-wrap: nowrap;
        justify-content: space-between;
        align-items: stretch;
        padding: 6px;
    }
    .description {
        min-height: 50px;
        padding: 10px;
        width: 95%;
        text-align: center;
    }
    .time {
        font-size: 10px;
        padding-left: 10px;
        text-align: end;
        margin: 5px;
    }
    .choose {
        width: 95%;
        height: 30px;
        background: blue;
        margin: 5px auto;
        text-align: center;
        border-radius: 10px;
        color: white;
        display: block;
        padding-top: 10px;
    }
    @media screen and (max-width: 600px) {
        .card {
            width: 99%;
        }
    }
</style>
